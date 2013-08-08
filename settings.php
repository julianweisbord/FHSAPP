<?php session_start();?>

<!DOCTYPE HTML>

<!--Notes:
	-Remember mysql_insert_id(); Gets the id of the last executed query, so will be important
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
					new_password_2: {
						equalTo: "input[name=new_password]" //To make sure the new password is working
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

ini_set('display_errors', 0); //Change from 0 to 1 and back for errors.
error_reporting(E_ALL);

$db = new Db($dbConfig);

?>
<br />
	<div class="wrapper">
		
		<?php
////////////SESSION VARIABLES//////////////////////////////////////////////////////////////////////////////////////////////////////
			$user_id = $_SESSION['user_id']; //Change this later, should equal $_SESSION['user_id']. This is linked to Generic User.
			//Permissions should be global SESSION variables:
				$admin = $_SESSION['admin'];
				$teacher = $_SESSION['teacher'];
				$club = $_SESSION['club'];
				$sports = $_SESSION['sports'];
			//
			
			
//////////////**SUBMITTING THE FORM**///////////////////////////////////////////////////////////////////////////////////////////////			
				if(!empty($_REQUEST)) {//*Checks if anything has been submitted from the form yet.
				
////////////////////INSERT STUFF (if it doesn't exist yet) ////////////////////////////////////////////////////////////////////////
					//*Insert periods for teachers
					if($teacher) {
						$periods = array(
							$_REQUEST['p1'],
							$_REQUEST['p2'],
							$_REQUEST['p3'],
							$_REQUEST['p4'],
							$_REQUEST['p5'],
							$_REQUEST['p6'],
							$_REQUEST['p7'],
							$_REQUEST['p8']
						);
						
						$query = "SELECT id, name, period FROM subtype WHERE author_id = '$user_id' AND type_id = '2';";
						$existing_periods = $db->runQuery($query);
						//echo "<pre>" . print_r($periods) . "</pre>";
						if(empty($existing_periods)) {
							for($i = 0; $i < count($periods); $i++) {
								$period_number = $i + 1;
								$query = "INSERT INTO subtype(name, type_id, author_id, period) VALUES ('$periods[$i]', '2', '$user_id', '$period_number');";
								mysql_query($query);
							}
							
							//$query = "INSERT INTO subtype(name, type_id, author_id, period) VALUES ('$p1', '2', '$user_id', '1');";
							//mysql_query($query);
							echo "<b>Classes have been inserted!</b><br />";
						}
					}
				
////////////////////UPDATE STUFF///////////////////////////////////////////////////////////////////////////////////////////////////
					//*Update your password first
					$new_password = $_REQUEST['new_password']; //ADD HASHES!!!
					if(!empty($new_password)) { //*Checks to see if the password has been made
						$hash = md5($new_password);
						$query = "UPDATE users SET password = '$hash' WHERE id = '$user_id';";
						mysql_query($query);
						echo "<b>Password Set!</b><br />";
					}
					
					//*Update the user.
					$username = $_REQUEST['username'];
					$first_name = $_REQUEST['first_name'];
					$last_name = $_REQUEST['last_name'];
					$email = $_REQUEST['email'];
					$query = "UPDATE users SET username = '$username', first_name = '$first_name', last_name = '$last_name', email = '$email' WHERE id = '$user_id';";
					mysql_query($query);
					echo "<b>Your user account information has been updated!</b><br />";
					
					//*Update teacher periods
					if($teacher) {
						for($i = 0; $i < count($periods); $i++) {
							$period_number = $i + 1;
							$query = "UPDATE subtype SET name = '$periods[$i]' WHERE author_id = '$user_id' AND period = '$period_number';";
							mysql_query($query);
						}
						
						//$query = "UPDATE subtype SET name = '$p1' WHERE author_id = '$user_id' AND period = '1';";
						//mysql_query($query);
						echo "<b>Classes have been updated!</b><br />";
					}
				}
				
////////////////SELECTING VALUES FOR INPUTS////////////////////////////////////////////////////////////////////////////////////////
				
				$user_data = mysql_fetch_array(mysql_query("SELECT username, password, first_name, last_name, email FROM users WHERE id = '$user_id';")); //Gonna need an inner join so you get all that other announcement stuff. Look up how to use mysql_fetch_array.
				
				$username = $user_data['username'];
				$first_name = $user_data['first_name'];
				$last_name = $user_data['last_name'];
				$email = $user_data['email'];

				////Teacher
				if($teacher) {
					$result = mysql_query("SELECT * FROM subtype WHERE author_id = '$user_id' AND type_id = '2' ORDER BY period;");
					$classes = array();
					while($rows = mysql_fetch_array($result)) {
						$classes[] = $rows;
					}
				}
				
		?>
		
		<pre>
			<?php //print_r($user_data);?>
			<?php //print_r($classes);?>
		</pre>
	
		<form id="form" method="get" action="settings.php">
			<label>Username:</label>
			<input name="username" type="text" value="<?php echo $username;?>"/> 
			<br />
			
			<!--Hey, probably don't need this.
			<label>Old Password:</label>
			<input name="old_password_check" type="password" value=""/> 
			<br />-->
			
			<label>New Password:</label>
			<input name="new_password" type="password" value=""/> 
			<br />
			
			<label>New Password Verification:</label>
			<input name="new_password_2" type="password" value=""/> 
			<br />
			
			<label>First Name:</label>
			<input name="first_name" type="text" value="<?php echo $first_name;?>"/> 
			<br />
			
			<label>Last Name:</label>
			<input name="last_name" type="text" value="<?php echo $last_name;?>"/> 
			<br />
			
			<label>Email:</label>
			<input name="email" type="text" value="<?php echo $email;?>"/> 
			<br />
			
			
			<h2>Your Classes Here:</h2>
			<p>If you have no class in that period, simply type in "Prep."</p>
			
			<!--
			<label>Period 1</label>
			<input name="p1" type="text" value="<?=$p1['name']?>"/> 
			<br />
			
			
			<label>Period 2</label>
			<input name="p2" type="text" value=""/> 
			<br />
			
			<label>Period 3</label>
			<input name="p3" type="text" value=""/> 
			<br />
			
			<label>Period 4</label>
			<input name="p4" type="text" value=""/> 
			<br />
			
			<label>Period 5</label>
			<input name="p5" type="text" value=""/> 
			<br />
			
			<label>Period 6</label>
			<input name="p6" type="text" value=""/> 
			<br />
			
			<label>Period 7</label>
			<input name="p7" type="text" value=""/> 
			<br />
			
			<label>Period 8</label>
			<input name="p8" type="text" value=""/> 
			<br /> -->
			
			
			<?php 
			if($teacher) {
				//Making the class inputs:
				$i = 1;
				if(!empty($classes)) { //If the classes exist, put in the values.
					foreach($classes as $class) {
						echo "<label>Period $i</label>
						<input name='p" . $i . "' type='text' value='".$class['name']."'/>
						<br />";
						$i++;
					}
				} else { //If the classes haven't been made yet, make them empty.
					for($j=1;$j<9;$j++) {
						echo "<label>Period $j</label>
						<input name='p" . $j . "' type='text' value=''/>
						<br />";
					}
				}
			}
			?> 
			
			
			<!--
			<h2>Clubs here:</h2>
			
			<label>Club:</label>
			<input name="c1" type="text" value=""/>
			<br />
			<!--Note: figure out how to make a button that will add a new club (a (+) button)
				Probably gonna involve js.
			-->
			
			<!--
			<h2>Sports here:</h2>
			
			<label>Sport:</label>
			<input name="s1" type="text" value=""/>
			<br />
			<!--See note above-->
			
			<input type="submit" value="Save"/>
		</form>
		<br />
		<a href="main.php">Back to Home</a><br />
	</div>
</body>

</html>