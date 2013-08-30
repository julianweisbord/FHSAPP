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

<?php
	//Inserting stuff.
	if($_REQUEST) {
		
	}
?>

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
					content: {
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
			
			<label>Content:</label>
			<textarea name="content" rows="5" col="50"></textarea>
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
					<input name="pcheck[]" type="checkbox" value="'.$id.'" />
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
					<input name="ccheck[]" type="checkbox" value="'.$id.'" />
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
					<input name="scheck[]" type="checkbox" value="'.$id.'" />
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