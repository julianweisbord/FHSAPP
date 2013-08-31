<?php 
session_start(); 
require_once('functions.php');
enforce_log();

?>

<?php 

require_once('lib/config.php');
require_once('lib/db.class.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

$db = new Db($dbConfig);

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
			$description = $_REQUEST['description'];
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



<!--This is gonna take some work. 

Form parts:
-title
-content
-start_date
-end_date
-date
-time
-location
-category (cats)
-publish

To do:
-content: Figure out how to make a fancier text editor, with the bold, italic, font size, that stuff. Called a rich text editor, also WYSIWYG. Check out http://www.tinymce.com/ and http://ckeditor.com/
-start and end dates: figure out the formatting and the popup calendar for convenience. Should be YYYY-MM-DD. http://xkcd.com/1179/
-category: will most likely have to be generated dynamically. That's gonna be interesting. Will need arrays and stuff.
-Eventually will need to add edit functionality too. All values are gonna end up php variables once we get the main done.

First, think we need the anno_subtype table to match the ids.
For inserting, it's going to have to do a few things...
It'll have to insert into the announcement table all the actual announcement info
and it'll have to insert into the anno_subtype table the announcement id matched to each subtype
I think let's start at just teacher functionality first. See if we can make the whole checkbox thing.
For the checkbox, the values are gonna have to be the ids of the subtypes. So I'm guessing if you do $_REQUEST['p1'], it'll return the value, right? Yes.
Okay, now inserting stuff.
-->



<html>

<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title>Create Announcement</title>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript"> //The easy way to validate. Credit this later.
	$(document).ready(
		function(){	
				jQuery.validator.addMethod("notEqual", function(value, element, param) {
  return this.optional(element) || value != param;
}, "Please specify a different (non-default) value");
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

		}
	);
	</script>
	<!--<link rel="stylesheet" href="style.css" />-->
</head>

<body>
	<div class="wrapper">
		<form id="form" method="get" action="create.php">
			<!--<label></label>
			<input name="" type="text" value=""/>
			<br />-->
		
			<label>Title:</label>
			<input name="title" type="text" value="" />
			<br />
			
			<label>Description:</label>
			<textarea name="description" rows="5" col="50"></textarea>
			<br />
			
			<label>Announcement Starting Date:</label>
			<input name="start_date" type="text" value=""/>
			<br />
			
			<label>Announcement End Date:</label>
			<input name="end_date" type="text" value=""/>
			<br />
			
			<h3>Categories:</h3>
			<!--php must generate these...-->
			<?php
			if($teacher_p) {
				$query = "SELECT * FROM subtype WHERE author_id='$user_id' AND type_id='2'";
				$periods = $db->runQuery($query);
				echo "<p>Classes:</p><br />";
				foreach($periods as $period) {
					$id = $period['id'];
					$name = $period['name'];
					$number = $period['period'];
					
					echo '<label>Period '.$number.': '.$name.'</label>
					<input name="check[]" type="checkbox" value="'.$id.'" />
					<br />';
				}
			}
			
			
			if($club_p) {
				$query = "SELECT * FROM subtype WHERE author_id='$user_id' AND type_id='3'";
				$clubs = $db->runQuery($query);
				echo "<p>Club(s):</p><br />";
				foreach($clubs as $club) {
					$id = $club['id'];
					$name = $club['name'];
					
					echo '<label>'.$name.':</label>
					<input name="check[]" type="checkbox" value="'.$id.'" />
					<br />';
				}
			}
			
			if($sports_p) {
				$query = "SELECT * FROM subtype WHERE author_id='$user_id' AND type_id='4'";
				$sports = $db->runQuery($query);
				echo "<p>Sport(s):</p><br />";
				foreach($sports as $sport) {
					$id = $sport['id'];
					$name = $sport['name'];
					
					echo '<label>'.$name.':</label>
					<input name="check[]" type="checkbox" value="'.$id.'" />
					<br />';
				}
			}
			?>
			
			<h3>Optional:</h3>
			<label>Actual Date of Event:</label>
			<input name="date" type="text" value=""/>
			<br />
			
			<label>Time of Event:</label>
			<input name="time" type="text" value=""/>
			<br />
			
			<label>Location:</label>
			<input name="location" type="text" value=""/>
			<br />
			
			<input type="submit" value="Create Announcement" />
			
			<br /><a href="main.php">Back to Home</a><br />
		</form>
	</div>
</body>

</html>