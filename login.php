<?php
include('lib/config.php');
include('lib/db.class.php');

ini_set('display_errors',0);
error_reporting(E_ALL);
$db = new Db($dbConfig);


//if($_POST['user'])

login();
function login(){

$typedusername= (addslashes($_POST['user'])); //thought we didn't need the array or slashes -- could be wrong
//$typedhash = hash('sha256'($_POST['pass']) until we get the hashes working in the db
$typedhash= md5((addslashes($_POST['pass'])));
//$con = mysql_connect("alvord.canvashost.com:2083/", "fhsapp", "rainorshine4");
//$db_select = mysql_select_db("fhsapp_v2", $con); //credentials to connect
//old connection methods

$result = mysql_query("SELECT password FROM users WHERE username='".$typedusername."'");
if(!$result) { die('goofed' . mysql_error() ); }
$hash = null; //this isn't needed, right?
if($result){
	$row = mysql_fetch_row($result);
	$hash = $row[0]; 
	}else{
		//echo "Invalid Username.";
	}
if($typedhash === $hash){
	//echo "Login Successful";
	$_SESSION['user'] = $typedusername;
	header('Location: loginsuccessful.html');
	exit();
	}else{
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

	<div class="row"><input name="user" onblur="if (this.value=='') this.value='Username'" onfocus="if (this.value=='Username') 		this.value = ''" type="text" value="Username"></div> 

	<div class="row"><input id="password_text" onfocus="this.style.display='none';document.getElementById('password').style.display='block'; document.getElementById('password').focus()" type="text" value="Password"><input onblur="if (this.value==''){this.style.display='none';document.getElementById('password_text').style.display='block'}" id="password" style="display: none" type="password" name="pass"/></div>

	<input type="submit" value="Login"/>

</fieldset>
	<br/>
	<input type="checkbox" id="staylogged" name="staylogged"/> <label for="staylogged">Stay Logged In</label>
</form>

</body>
</html>