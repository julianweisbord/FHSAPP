<?php 
session_start(); 
require_once('functions.php');
enforce_log();

?>

<!DOCTYPE HTML>

<?php 

require_once('lib/config.php');
require_once('lib/db.class.php');

ini_set('display_errors', 0);
error_reporting(E_ALL);

$db = new Db($dbConfig);

?>

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
-->

<?php
	
?>

<html>

<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title>Create Announcement</title>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<link rel="stylesheet" href="style.css" />
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
			
			<!--if(teacher)-->
			<label>Period 1</label>
			<input name="p1" type="checkbox" value="" />
			<br />
			
			<label>Period 2</label>
			<input name="p2" type="checkbox" value="" />
			<br />
			
			<label>Period 3</label>
			<input name="p3" type="checkbox" value="" />
			<br />
			
			<label>Period 4</label>
			<input name="p4" type="checkbox" value="" />
			<br />
			
			<label>Period 5</label>
			<input name="p5" type="checkbox" value="" />
			<br />
			
			<label>Period 6</label>
			<input name="p6" type="checkbox" value="" />
			<br />
			
			<label>Period 7</label>
			<input name="p7" type="checkbox" value="" />
			<br />
			
			<label>Period 8</label>
			<input name="p8" type="checkbox" value="" />
			<br />
			<!--if(clubs)-->
			
			<!--if(sports)-->
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