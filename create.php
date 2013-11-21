<?php 
session_start(); 
require_once('lib/config.php');
require_once('lib/db.class.php');
ini_set('display_errors', 0);
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
		$subtype_ids = $_REQUEST['check'];
		if(!empty($subtype_ids)) {
			//*Insert the actual announcement into the announcement table
			$title = $_REQUEST['title'];
			$description = mysql_real_escape_string( $_REQUEST['description'] );
			$start_date = $_REQUEST['start_date'];
			$end_date = $_REQUEST['end_date'];
			$date = $_REQUEST['date'];
			$location = $_REQUEST['location'];
			$time = $_REQUEST['time'];
			
			$query = "INSERT INTO announcements(title, description, start_date, end_date, date, location, time, author) VALUES('$title', '$description', '$start_date', '$end_date', '$date', '$location', '$time', '$user_id');";
			mysql_query($query);
			
			//*Insert the anno_subtype relationship into its table
			$anno_id = mysql_insert_id();
			//echo $anno_id;
			foreach($subtype_ids as $subtype_id) {
				$query = "INSERT INTO anno_subtype(anno_id, subtype_id) VALUES('$anno_id', '$subtype_id');";
				mysql_query($query);
			}
			//redirect here maybe?
		} //else {
			//$need_check = true; //*Use this to make a comment that says something needs to be checked.
		//}
	}

?>
<!DOCTYPE HTML>

<html>

<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title>Create Announcement</title>
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
					/*description: {
						required: true,
					},*/
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
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.3.custom.min.css" />
</head>

<body>
	<!--Header goes here-->
	<div class="header">
		<img class="logo" src="http://fhsapp.com/v2/Images/daytime.png">
		
		<div class="buttons">
			 <a class="logout_button" href="logout.php">Log Out</a>
		</div>	
		
		<div class="settings_button" >
			<a href="settings.php"><img src="images/settings_gear.png" width="40" height="40"/></a>
		</div>
		
		
		
		<div class="home_button_div">
		 <a class="home_button" href="main.php?current=1">Home</a>
		</div>
		<?php
		if($_SESSION['admin']) {
			echo '<div class="new_user_button" >';
			echo '<a href="new_user.php">Create New User</a><br />';
			echo '</div>';
		}
		?>
		<a href="create.php">
			<div class="add_announcements_wrapper">
			<div class="add_announcements_button">Add Announcement</div>
			<img class="add_image" src="images/add.png" /> <!--Icons by DryIcons-->
			</div>
		</a>
		
	</div>	

	<div class="create_wrapper">
		<form id="form" method="get" action="create.php" class="anno_form">
			<!--<label></label>
			<input name="" type="text" value=""/>
			<br />-->
			<div class="anno_left">
			<div class="anno_title">
				<label class="anno_title_label">Title:</label>
				<input name="title" type="text" value="" class="anno_text"/>
				<br />
			</div>
			
			<div class="anno_description">
				<label class="anno_description_label">Description:</label>
				<textarea name="description" rows="5" col="50" class="anno_textarea"></textarea>
				<br />
			</div>
			
			<div class="anno_start_end">
				<div class="anno_start_date">
					<label class="anno_start_date_label">Announcement Starting Date:</label>
					<input id="start_date" name="start_date" type="text" value="" class="anno_text"/>
					<br />
				</div>
			
				<div class="anno_end_date">
					<label class="anno_end_date_label">Announcement End Date:</label>
					<input id="end_date" name="end_date" type="text" value="" class="anno_text"/>
					<br />
				</div>
			</div>
			
			<div class="anno_optional">
				<h3>Optional:</h3>
				
				<div class="anno_date">
					<label class="anno_date_label">Actual Date of Event:</label>
					<input id="date" name="date" type="text" value=""/>
					<br />
				</div>
				
				<div class="anno_time">
					<label class="anno_time_label">Time of Event:</label>
					<input name="time" type="text" value=""/>
					<br />
				</div>
				
				<div class="anno_location">
					<label class="anno_location_label">Location:</label>
					<input name="location" type="text" value=""/>
					<br />
				</div>
			</div>
			</div>
			
			<div class="anno_right">
			<div class="anno_cats">
				<h3>Categories:</h3>
				<!--php must generate these...-->
				<?php
				if($admin_p) {
					$query = "SELECT * FROM subtype WHERE type_id = '1'";
					$generals = $db->runQuery($query);
					echo "<div class='cat_div'><p class='cat_label'>General:</p><br />";
					foreach($generals as $general) {
						$id = $general['id'];
						$name = $general['name'];
						if(!empty($name)) {
							echo '<label class="cat_subtype_label">'.$name.':</label>
							<input name="check[]" type="checkbox" value="'.$id.'" />
							<br />';
						}
					}
					echo "</div>";
				}
				
				if($teacher_p) {
					$query = "SELECT * FROM subtype WHERE author_id='$user_id' AND type_id='2'";
					$periods = $db->runQuery($query);
					echo "<div class='cat_div'><p class='cat_label'>Classes:</p><br />";
						foreach($periods as $period) {
						$id = $period['id'];
						$name = $period['name'];
						$number = $period['period'];
						if(!empty($name)) {
							echo '<label class="cat_subtype_label">Period '.$number.': '.$name.'</label>
							<input name="check[]" type="checkbox" value="'.$id.'" />
							<br />';
						}
					}
					echo "</div>";
				}
				
				if($club_p) {
					$query = "SELECT * FROM subtype WHERE author_id='$user_id' AND type_id='3'";
					$clubs = $db->runQuery($query);
					echo "<div class='cat_div'><p class='cat_label'>Club(s):</p><br />";
					foreach($clubs as $club) {
						$id = $club['id'];
						$name = $club['name'];
						echo '<label class="cat_subtype_label">'.$name.':</label>
						<input name="check[]" type="checkbox" value="'.$id.'" />
						<br />';
					}
					echo "</div>";
				}
				
				if($sports_p) {
					$query = "SELECT * FROM subtype WHERE author_id='$user_id' AND type_id='4'";
					$sports = $db->runQuery($query);
					echo "<div class='cat_div'><p class='cat_label'>Sport(s):</p><br />";
					foreach($sports as $sport) {
						$id = $sport['id'];
						$name = $sport['name'];
						echo '<label class="cat_subtype_label">'.$name.':</label>
						<input name="check[]" type="checkbox" value="'.$id.'" />
						<br />';
					}
					echo "</div>";
				}
				?>
			</div>
			
			<div class="anno_submit">
				<input type="submit" value="Create Announcement" />
			</div>
			<br />
			</div>
				
			<br />
		</form>
	</div>
</body>

</html>