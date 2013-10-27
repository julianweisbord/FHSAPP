<?php 
session_start(); 
require_once('functions.php');


//echo $_SESSION['username']; //Comment out eventually
//echo $_COOKIE['staylogged'];
	
include('lib/config.php');
include('lib/db.class.php');


ini_set('display_errors',0);
error_reporting(E_ALL);
$db = new Db($dbConfig);
//Maybe make a function that takes all the Session variables and sticks them into easier to use variable names.
enforce_log();
$user_id = $_SESSION['user_id'];

//Sorting functionality shall go here.
if(isset($_REQUEST['subtype_id'])) {
	$subtype_id = $_REQUEST['subtype_id'];
} else {
	$subtype_id = 0; //Comment this out later. The value should be set to 0 when selecting all subtypes.
}

if($subtype_id) {
	$query = "SELECT * FROM announcements INNER JOIN anno_subtype ON announcements.id = anno_subtype.anno_id WHERE anno_subtype.subtype_id = '$subtype_id'";
	$announcements=$db->runQuery($query);
} 

if(!$subtype_id) {
	$query = "SELECT * FROM announcements WHERE author='$user_id'";
	$announcements=$db->runQuery($query);
}

?>

<!DOCTYPE HTML>

<!--Okay, this is tough. In order to make the sorting functionality that we want, I think it'd be best to simply grab all the announcements
in an array from the db, then everytime that it's sorted. But then, that array would only be accessible through the php, unless we manage to
stick that array into one used by javascript and then use javascript to write the table instead of php. The other option would be to use an
iframe that somehow...

	Okay, looks like it could work just by resubmitting the page each time. However, the problem is that we need to figure out how to make 
it submit with the variable that tells it to get only the selected categories.

	Make it so each button for each category has a link back to the main page with a variable at the end of the url like ?anno_id=#.
	
	Steps:
	DONE 1.Start with getting all of them:
	DONE  a.Select all the announcements BASED ON author ids.
	DONE  b.Shove them into the table below
	DONE 2.-Once that works, add the sorting functionality. May finally use the JOIN property here.
	DONE  a.Select all the subtypes from the subtypes table based on author ids.
	DONE  b.Make the buttons with the hrefs that will have something like ?subtype_id=# at the end of them based on the subtypes.
	DONE  c.Using the subtype_id given to the main.php, it'll go to the anno_subtype table and find all the anno_ids associated with that 
	  subtype then grab all the announcements based on the anno_ids. The JOIN property will most likely be used here.
	Looks like this is all it's gonna take.
-->
<html>


<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title></title>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<div class="header">
		<img class="logo" src="http://fhsapp.com/v2/Images/daytime.png">
		
		<div class="buttons">
			 <a class="logout_button" href="logout.php">Log Out</a>
		</div>	
		
		<div class="settings_button" >
			<a href="settings.php"><img src="images/settings_gear.png" width="40" height="40"/></a>
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
	<div class="columns_wrapper">
		<div class="columns">
			<div class="column">			
			<li id="category_buttons">
			<?php
				$query = "SELECT * FROM subtype WHERE author_id = '$user_id'";
				$cat_buttons = $db->runQuery($query);
				foreach($cat_buttons as $cat_button) {
					$id = $cat_button['id'];
					$name = $cat_button['name'];
					$period = $cat_button['period'];
					
					if(!empty($name)) {
						if($period) {
							echo "<ul>";
							echo "<a href='main.php?subtype_id=".$id."'>Period ".$period.": $name</a>";
							echo "</ul>";
						} else {
							echo "<ul>";
							echo "<a href='main.php?subtype_id=".$id."'>$name</a>";
							echo "</ul>";
						}
					}
				}
			?>
			</li>
			
			<div class="wrapper">
				<!--<pre>
					<?php print_r($announcements);?>
				</pre>-->
				<table border="1">
					<tr>
						<th>Name</th>
						<th>Categories</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
					<!--<tr>
						<td><a href="edit_test.php?anno_id=17">Test Announcement</a></td>
						<td>Test</td>
						<td><a href="edit_test.php?anno_id=17">Edit<<a></td>
						<td><<a href="delete.php?anno_id=17">Delete<a></td>
					</tr>-->
					<?php 
						foreach($announcements as $announcement) {
							echo "<tr>";
							//Use some form of an INNER JOIN here to select announcement category. Joins anno_subtype with subtype.
							$query = "SELECT * FROM subtype INNER JOIN anno_subtype ON subtype.id = anno_subtype.subtype_id WHERE anno_subtype.anno_id = '{$announcement["id"]}'";
							$cats = $db->runQuery($query);
							echo '<td><a href="edit.php?anno_id='.$announcement["id"].'">'.$announcement["title"].'</a></td>';
							echo'<td>';
							foreach ($cats as $cat) {
								if($cat['period']) {
									echo "Period ";
									echo $cat['period'];
									echo ": ";
								}
								echo $cat['name'];
								echo '.<br />';
							}
							echo '</td>';
							echo '<td><!--<a href="edit.php?anno_id='.$announcement["id"].'">-->Edit<!--<a>--></td>
							<td><!--<a href="delete.php?anno_id='.$announcement["id"].'">-->Delete<!--<a>--></td>';
							echo "</tr>";
						}
					?>
				</table>
			</div>
			</div>
		</div>
	</div>
	
</body>

</html>