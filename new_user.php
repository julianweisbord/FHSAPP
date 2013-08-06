<!DOCTYPE HTML>

<!--Notes:
	-Remember mysql_insert_id(); Gets the id of the last executed query, so will be important
	-For admins making new users only. Should not concern making the subtypes whatsoever, that's the user's job.
-->
<html>

<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title>Settings</title>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript"> //The easy way to validate. Credit this later.
	$(document).ready(
		function(){	
			$("#form").validate({
				rules: {
					username: {
						required: true,
					},
					email: {
						required: true,
						email: true
					},
					first_name: {
						required: true,
					},
					last_name: {
						required: true,
					},
					password: {
						required: true,
					},
					password_2: {
						required: true,
						equalTo: "input[name=password]"
					}
				}
			});
		}
	);
	</script>
	<link rel="stylesheet" href="style.css" />
</head>

<body>

<?php

require_once('lib/config.php');
require_once('lib/db.class.php');

ini_set('display_errors', 0);
error_reporting(E_ALL);

$db = new Db($dbConfig);
?>

	<div class="wrapper">
		<?php
			function checkbox_checked($checkbox_value) {
				if($checkbox_value == "on") {
					return 1;
				} else {
					return 0;
				}
			};
			if(!empty($_REQUEST)) {
			//Make associative array??? NAH
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password']; //ADD HASHES!!!!
			$password_2 = $_REQUEST['password_2']; 
			$first_name = $_REQUEST['first_name']; 
			$last_name = $_REQUEST['last_name']; 
			$email = $_REQUEST['email']; 
			$admin = checkbox_checked($_REQUEST['admin']);
			$teacher = checkbox_checked($_REQUEST['teacher']);
			$club = checkbox_checked($_REQUEST['club']);
			$sports = checkbox_checked($_REQUEST['sports']);
		
			//?Add something to prevent duplicates	
			if($admin||$teacher||$club||$sports) {	
				$query = "INSERT into users(username, password, email, first_name, last_name, admin, teacher, club, sports) VALUES('$username', '$password', '$email', '$first_name', '$last_name', '$admin', '$teacher', '$club', '$sports');";
				mysql_query($query);
				echo "<p>New user has been created!</p>";
			} else {
				//?Add something to prevent this from showing up the first time.
				echo "<p style='color:red;'>Please select a permission.</p>";
			}
			}
			
		?>
	
		<form id="form" method="get" action="new_user.php">
			<label>Username:</label>
			<input name="username" type="text" value=""/> 
			<br />
			
			<label>New Password:</label>
			<input name="password" type="password" value=""/> 
			<br />
			
			<label>New Password Verification:</label>
			<input name="password_2" type="password" value=""/> 
			<br />
			
			<label>First Name:</label>
			<input name="first_name" type="text" value=""/> 
			<br />
			
			<label>Last Name:</label>
			<input name="last_name" type="text" value=""/> 
			<br />
			
			<label>Email:</label><!--Do that automatic emailing of password and stuffs.-->
			<input name="email" type="text" value=""/> 
			<br />
			
			<!--Permissions-->
			<h1>Permissions</h1>
			
			<label>Admin:<label>
			<input name="admin" type="checkbox" />
			<br />
			
			<label>Teacher:<label>
			<input name="teacher" type="checkbox" />
			<br />
			
			<label>Club Leader/Supervisor:<label>
			<input name="club" type="checkbox" />
			<br />
			
			<label>Coach/Sports Supervisor:<label>
			<input name="sports" type="checkbox" />
			<br />
			
			<input type="submit" value="Create New User"/>
		</form>
	</div>
</body>

</html>