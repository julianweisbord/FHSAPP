<?php session_start();?>

<!DOCTYPE HTML>

<!--Notes:
	-Remember mysql_insert_id(); Gets the id of the last executed query, so will be important
	-For admins making new users only. Should not concern making the subtypes whatsoever, that's the user's job.
-->
<html>

<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title>New User</title>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript"> //The easy way to validate. Credit this later.
	$(document).ready(
		function(){	
				jQuery.validator.addMethod("notEqual", function(value, element, param) {
  return this.optional(element) || value != param;
}, "Please specify a different (non-default) value");
	$("#form").validate({
				rules: {
					username: {
						required: true,
						'notEqual': "Username"
					},
					email: {
						required: true,
						email: true,
						'notEqual': "E-Mail"
					},
					first_name: {
						required: true, 
						'notEqual': "First Name"
					},
					last_name: {
						required: true,
						'notEqual': "Last Name"
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

<body class="new_user">

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
				$username = $_REQUEST['username'];
				$e_password = $_REQUEST['password']; //For emailing
				$password = md5($_REQUEST['password']);
				$first_name = $_REQUEST['first_name']; 
				$last_name = $_REQUEST['last_name']; 
				$email = $_REQUEST['email']; 
				$admin = checkbox_checked($_REQUEST['admin']);
				$teacher = checkbox_checked($_REQUEST['teacher']);
				$club = checkbox_checked($_REQUEST['club']);
				$sports = checkbox_checked($_REQUEST['sports']);
				
				//*Duplicate prevention
				$already_exists = 0;
				$existing_users = $db->runQuery('SELECT username FROM users;');
				foreach($existing_users as $existing_user) {
					if($existing_user['username'] == $username) {
						$already_exists = 1;
						break;
					}
				}
				
				if(!$already_exists) { //*Check if they exist.
					if($admin||$teacher||$club||$sports) {	//*Has permission been selected?
						$e_subject = "Fhsapp Username and Password";
						$e_content = "Your login credentials for Fhsapp: \nUsername: $username\n\nPassword: $e_password";
						$mail = mail($email, $e_subject, $e_content); //*EMAIL!!!
						if($mail) {
							//*Once the mail has worked
							//*Create the user
							$query = "INSERT into users(username, password, email, first_name, last_name, admin, teacher, club, sports) VALUES('$username', '$password', '$email', '$first_name', '$last_name', '$admin', '$teacher', '$club', '$sports');";
							mysql_query($query);
							echo "<p>New user has been created!</p>";
						} else {
							echo "<p style='color:red;'>Email not valid.</p>";
						}
					} else {
						echo "<p style='color:red;'>Please select a permission.</p>";
					}
				} else {
					echo "<p style='color:red;'>This user already exists!</p>";
				}
			}	
		?>
	

		<div id="form-wrap">

<form id="form" action="new_user.php" method="post" name="new_user_form">

	<fieldset>

	<legend><center><h2>Sign Up</h2></center></legend>

	<div class="row"><input name="first_name" onblur="if (this.value=='') this.value='First Name'" onfocus="if (this.value=='First Name') this.value = ''" type="text" value="First Name"></div>
	 
	<div class="row"> <input name="last_name" onblur="if (this.value=='') this.value='Last Name'" onfocus="if (this.value=='Last Name') this.value = ''" type="text" value="Last Name"></div> <!--<label>Last Name: </label><input type="text" name="last_name"/>-->

	<div class="row"> <input name="email" onblur="if (this.value=='') this.value='E-Mail'" onfocus="if (this.value=='E-Mail') this.value = ''" type="text" value="E-Mail"></div><!-- <label>E-Mail: </label><input type="text" name="e-mail"/>-->
	
	<div class="row"><input name="username" onblur="if (this.value=='') this.value='Username'" onfocus="if (this.value=='Username') this.value = ''" type="text" value="Username"></div> <!--<label>Username: </label><input type="text" name="username"/>-->

<!--To solve the problem that the password type has to display the dots when clicked and that the box should also display non-dotted words before clicked: 

		document.getElementById('password').focus() moves the curser from the first text box to the next and style="display: none" hides the second text box. onblur displays the origional text when we click something else-->

	<div class="row"> <input id="password_text" onfocus="this.style.display='none';document.getElementById('password').style.display='block'; document.getElementById('password').focus()" type="text" value="Password"><input onblur="if (this.value==''){this.style.display='none';document.getElementById('password_text').style.display='block'}" id="password" style="display: none" type="password" name="password"/></div>

	<div class="row"> <input id="password_text2" onfocus="this.style.display='none';document.getElementById('password2').style.display='block'; document.getElementById('password2').focus()" type="text" value="Re-enter Password"><input onblur="if (this.value==''){this.style.display='none';document.getElementById('password_text2').style.display='block'}" id="password2" style="display: none" type="password" name="password"/></div>



		<div id="categories">I Am A:<br/>
		<input type="checkbox" name="teacher"/> Teacher
		<input type="checkbox" name="coach"/> Coach
		<input type="checkbox" name="club_leader"/> Club Leader
		</div>
		<div><input type="submit" value="Submit"/></div>

</fieldset>
</form>
	</div>
</body>

</html>