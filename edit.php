<?php 
session_start(); 
require_once('lib/config.php');
require_once('lib/db.class.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
$db = new Db($dbConfig);
require_once('functions.php');
enforce_log();
?>

<?php 
$user_id = $_SESSION['user_id']; 
$admin_p = $_SESSION['admin'];
$teacher_p = $_SESSION['teacher'];
$club_p = $_SESSION['club'];
$sports_p = $_SESSION['sports'];
?>

<?php
	//Inserting stuff.
	if(!empty($_REQUEST)) {
		//$anno_id = 17;
		$anno_id = $_REQUEST['anno_id']; //*Get the announcment id from the address
		
		$query = "SELECT * FROM announcements WHERE id='$anno_id'"; //*Get the announcement
		$anno_info = $db->runQuery($query); //*Put the anno info into this array
		foreach ($anno_info as $info) {
			/*echo "<pre>";
			print_r($info);
			echo "</pre>";*/
			$title = $info['title'];
			$description = $info['description'];
			$start_date = $info['start_date'];
			$end_date = $info['end_date'];
			$date = $info['date'];
			$location = $info['location'];
			$time = $info['time'];
		} 
		
		
		//*Also gonna need the anno_subtype relationships so you know what to check.
		$query = "SELECT * FROM anno_subtype WHERE anno_id='$anno_id'";
		$anno_cb = $db->runQuery($query); //*This is where the the checkbox info is
		
		//*This is for updating the announcements
		$subtype_ids = $_REQUEST['check']; //check is the name of the checkbox array. Subtype_ids contains all the subtypes that the announcement is associated with.
		if(!empty($subtype_ids)) {
			//*Insert the actual announcement into the announcement table
			$title = $_REQUEST['title'];
			$description = mysql_real_escape_string( $_REQUEST['description'] );
			$start_date = $_REQUEST['start_date'];
			$end_date = $_REQUEST['end_date'];
			$date = $_REQUEST['date'];
			$location = $_REQUEST['location'];
			$time = $_REQUEST['time'];
			
			$query = "UPDATE announcements SET title='$title', description='$description', start_date='$start_date', end_date='$end_date', date='$date', location='$location', time='$time' WHERE id='anno_id';";
			mysql_query($query);
			
			//This was breaking.
			//*Insert the anno_subtype relationship into its table
			//*First delete all the existing ones
			$query = "DELETE FROM anno_subtype WHERE anno_id='$anno_id'";
			mysql_query($query);
			
			//*Then, insert the new ones.
			foreach($subtype_ids as $subtype_id) {
				$query = "INSERT INTO anno_subtype(anno_id, subtype_id) VALUES('$anno_id', '$subtype_id');";
				mysql_query($query);
			}
		}
			//redirect here maybe?
	} //else {
		//$need_check = true; //*Use this to make a comment that says something needs to be checked.
	//}
	

?>
<!DOCTYPE HTML>

<!--
Okay, this is gonna be more work. The focus of this page is to update the announcements. It's going to be few a variable from the
main page like ?id=# and this is going to have to grab that variable and use the id to fill up the slots. Then it'll fill up the
inputs based on that and ONLY UPDATE the announcement when submitted.

To do:
DONE-Grab the subtypes from db so you can check them. Remember checked="checked"
-Make it update.
-->

<html>

<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title>Update Announcement</title>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<!--Credit: http://jqueryvalidation.org/-->
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<!--Credit: http://api.jqueryui.com/-->
	<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
	<!--Credit: http://www.tinymce.com/index.php-->
	<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript">
		tinymce.init({
			selector: "textarea",
			plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				//"insertdatetime media table contextmenu paste moxiemanager" //*Don't think this plugin matters
			],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
		});

	$(document).ready(
		function(){	
			jQuery.validator.addMethod("notEqual", function(value, element, param) {return this.optional(element) || value != param;}, "Please specify a different (non-default) value");
			$("form").validate({
				ignore: "",
				rules: {
					title: {
						required: true,
					},
					description: {
						required: true,
					},
					start_date: {
						required: true,
					},
					end_date: {
						required: true,
					}
				}
			});
			
			$("#start_date").datepicker({ dateFormat: "yy-mm-dd" });
			$("#end_date").datepicker({ dateFormat: "yy-mm-dd" });
			$("#date").datepicker({ dateFormat: "yy-mm-dd" });
		}
		
		
	);
	</script>
	<!--<link rel="stylesheet" href="style.css" />-->
	<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.3.custom.min.css" />
</head>

<body>
	<div class="wrapper">
		
		<form id="form" method="get" action="edit.php">
			<!--<label></label>
			<input name="" type="text" value=""/>
			<br />-->
		
			<label>Title:</label>
			<input name="title" type="text" value="<?php echo $title;?>" />
			<br />
			
			<label>Description:</label>
			<textarea name="description" rows="5" col="50"><?php echo $description;?></textarea>
			<br />
			
			<label>Announcement Starting Date:</label>
			<input id="start_date" name="start_date" type="text" value="<?php echo $start_date;?>"/>
			<br />
			
			<label>Announcement End Date:</label>
			<input id="end_date" name="end_date" type="text" value="<?php echo $end_date;?>"/>
			<br />
			
			<h3>Categories:</h3>
			<!--Gonna need to check if these are checked too...-->
			<?php
			if($teacher_p) {
				$query = "SELECT * FROM subtype WHERE author_id='$user_id' AND type_id='2'";
				$periods = $db->runQuery($query);
				echo "<p>Classes:</p><br />";
				foreach($periods as $period) {
					$checked = false;
					$id = $period['id'];
					$name = $period['name'];
					$number = $period['period'];
					foreach($anno_cb as $anno_cbc) {
						if($anno_cbc['subtype_id']==$id) {
							echo '<label>Period '.$number.': '.$name.'</label>
							<input name="check[]" type="checkbox" value="'.$id.'" checked="checked"/>
							<br />';
							$checked = true;
							break;
						}
					}
					if(!$checked) {
						echo '<label>Period '.$number.': '.$name.'</label>
						<input name="check[]" type="checkbox" value="'.$id.'" />
						<br />';
					}
				}
			}
			
			
			if($club_p) {
				$query = "SELECT * FROM subtype WHERE author_id='$user_id' AND type_id='3'";
				$clubs = $db->runQuery($query);
				echo "<p>Club(s):</p><br />";
				foreach($clubs as $club) {
					$checked = false;
					$id = $club['id'];
					$name = $club['name'];
					foreach($anno_cb as $anno_cbc) {
						if($anno_cbc['subtype_id']==$id) {
							echo '<label>'.$name.':</label>
							<input name="check[]" type="checkbox" value="'.$id.'" checked="checked"/>
							<br />';
							$checked = true;
							break;
						}
					}
					if(!$checked) {
						echo '<label>'.$name.':</label>
						<input name="check[]" type="checkbox" value="'.$id.'" />
						<br />';
					}
					
				}
			}
			
			
			if($sports_p) {
				$query = "SELECT * FROM subtype WHERE author_id='$user_id' AND type_id='4'";
				$sports = $db->runQuery($query);
				echo "<p>Sport(s):</p><br />";
				foreach($sports as $sport) {
					$checked = false;
					$id = $sport['id'];
					$name = $sport['name'];
					foreach($anno_cb as $anno_cbc) {
						if($anno_cbc['subtype_id']==$id) {
							echo '<label>'.$name.':</label>
							<input name="check[]" type="checkbox" value="'.$id.'" checked="checked"/>
							<br />';
							$checked = true;
							break;
						}
					}
					if(!$checked) {
						echo '<label>'.$name.':</label>
						<input name="check[]" type="checkbox" value="'.$id.'" />
						<br />';
					}
				}
			}
			?>
			
			<h3>Optional:</h3>
			<label>Actual Date of Event:</label>
			<input id="date" name="date" type="text" value="<?php if($date != "0000-00-00"){echo $date;}?>"/>
			<br />
			
			<label>Time of Event:</label>
			<input name="time" type="text" value="<?php echo $time;?>"/>
			<br />
			
			<label>Location:</label>
			<input name="location" type="text" value="<?php echo $location;?>"/>
			<br />
			
			<input name="anno_id" type="hidden" value="<?php echo $anno_id;?>"/>
			<input type="submit" value="Update Announcement" />
			
			<br /><a href="main.php">Back to Home</a><br />
		</form>
	</div>
</body>

</html>