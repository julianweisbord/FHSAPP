<?php
session_start();
include('lib/config.php');
include('lib/db.class.php');

ini_set('display_errors',0);
error_reporting(E_ALL);
$db = new Db($dbConfig);


//if($_POST['user'])
function set_session($typedusername) {
		$userdata = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username='$typedusername'"));
		$_SESSION['user_id'] = $userdata['id'];
		$_SESSION['admin'] = $userdata['admin'];
		$_SESSION['teacher'] = $userdata['teacher'];
		$_SESSION['club'] = $userdata['club'];
		$_SESSION['sports'] = $userdata['sports'];
		$_SESSION['username'] = $typedusername;
	}

if(!empty($_REQUEST)) {
	login();
}

function login(){
	
$typedusername= (addslashes($_POST['user'])); //thought we didn't need the array or slashes -- could be wrong
$typedhash= md5((addslashes($_POST['pass'])));

$result = mysql_query("SELECT password FROM users WHERE username='".$typedusername."'");
if(!$result) { die('goofed' . mysql_error() ); }

$hash = null; //this isn't needed, right?

if($result){
	$row = mysql_fetch_row($result);
	$hash = $row[0]; 
	} else {
		//echo "Invalid Username.";
	}
if($typedhash === $hash){
	//echo "Login Successful";
	set_session($typedusername);
	header('Location: loginsuccessful.html');
	exit();
	} else {
		 //echo "Login Failed."; 
	}
}

?>

<!DOCTYPE HTML>

<html>
<head>
	<title>Log In</title>
<link rel="stylesheet" type="text/css" href="style.css">


</head>
<body class="login">


<div id="form-wrap">

<form action="login.php" method="post" name="login_form">

	<fieldset>

	<legend><h2>Login</h2></legend>

	<div class="row">
		<input name="user" onblur="if (this.value=='') this.value='Username'" onfocus="if (this.value=='Username') 		this.value = ''" type="text" value="Username">
	</div> 

	<div class="row">
		<input id="password_text" onfocus="this.style.display='none';document.getElementById('password').style.display='block'; document.getElementById('password').focus()" type="text" value="Password">
		<input onblur="if (this.value==''){this.style.display='none';document.getElementById('password_text').style.display='block'}" id="password" style="display: none" type="password" name="pass"/>
	</div>

	<input type="submit" value="Login"/>

</fieldset>
	<br/>
	<input type="checkbox" id="staylogged" name="staylogged"/> <label for="staylogged">Stay Logged In</label>
</form>

</body>
</html>