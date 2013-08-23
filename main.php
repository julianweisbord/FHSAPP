<?php 
session_start(); 
require_once('functions.php');
enforce_log();


	echo $_SESSION['username']; //Comment out eventually
	
	include('lib/config.php');
	include('lib/db.class.php');

	ini_set('display_errors',0);
	error_reporting(E_ALL);
	$db = new Db($dbConfig);
	//Maybe make a function that takes all the Session variables and sticks them into easier to use variable names.
?>

<!DOCTYPE HTML>

<!---->
<html>

<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title></title>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<div class="columns_wrapper">
		<div class="columns">
			<div class="column">
			<?php 
				echo '<a href="settings.php">Settings</a><br />';
				if($_SESSION['admin']) {
					echo '<a href="new_user.php">New User</a><br />';
				}
				echo '<a href="create.php">Add Announcement</a><br />';
				echo '<a href="login.php">Log out</a><br />';
			?>
			</div>
		</div>
	</div>
</body>

</html>