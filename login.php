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
<!DOCTYPE html>
<title>Login</title>
<body>
<form name=LoginForm action="login.php" method="post">
	<label>Username</label><input type="text" name="user">
	<label>Password</label><input type="text" name="pass">
	<label>Keep me logged in</label><input type="checkbox" name="staylogged">
	<input type="submit" name="submit">
</form>

</body></html>