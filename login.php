<?php
session_start();
//$_SESSION['logged_in'] = 0; //IMPO'TANT BIZWAX TO BE DEALT WITH HERE. Ignore for now, but it will eventually turn into some sort of system for the staying logged, etc. May involve cookies.
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
	//$_SESSION['logged_in'] = 1;
}

if(!empty($_REQUEST)) {
	login();
}

function login(){
$typedusername= (addslashes($_REQUEST['user'])); //thought we didn't need the array or slashes -- could be wrong
$typedhash= md5((addslashes($_REQUEST['pass'])));

$result = mysql_query("SELECT password FROM users WHERE username='".$typedusername."'");

if(!$result) { die('goofed' . mysql_error() ); }

//$hash = null; //this isn't needed, right?

if($result){
	$row = mysql_fetch_row($result);
	$hash = $row[0];
	//echo "$hash, $typedhash";
} else {
	//echo "Invalid Username.";
}
	
if($typedhash == $hash){
	echo "Login Successful";
	set_session($typedusername);
	header('Location: main.php');
	exit();
} else {
	//echo "Login Failed."; 
}

}

?>
<!DOCTYPE html>
<title>Login</title>
<body>
<form name='LoginForm' action="login.php" method="get">
	<label>Username</label><input type="text" name="user">
	<label>Password</label><input type="password" name="pass">
	<label>Keep me logged in</label><input type="checkbox" name="staylogged">
	<input type="submit" name="submit">
</form>

</body></html>