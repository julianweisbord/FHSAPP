<?php 
	//For all your error needs
include('lib/config.php');
include('lib/db.class.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
$db = new Db($dbConfig); //boilerplate stuff
	function query_error($query) {
		if(!$query) {
			die('Could not connect: ' . mysql_error());
		}
	};

	//For the calendar needs
	function GetDays($sStartDate, $sEndDate){  
	// Firstly, format the provided dates.  
	// This function works best with YYYY-MM-DD  
	// but other date formats will work thanks  
	// to strtotime().  
	$sStartDate = gmdate("Y-m-d", strtotime($sStartDate));  
	$sEndDate = gmdate("Y-m-d", strtotime($sEndDate));  
  
	// Start the variable off with the start date  
	$aDays[] = $sStartDate;  
  
	// Set a 'temp' variable, sCurrentDate, with  
	// the start date - before beginning the loop  
	$sCurrentDate = $sStartDate;  
  
	// While the current date is less than the end date  
	while($sCurrentDate < $sEndDate){  
		// Add a day to the current date  
		$sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));  
  
		// Add this new day to the aDays array  
		$aDays[] = $sCurrentDate;  
	}  
  
	// Once the loop has finished, return the  
	// array of days.  
	return $aDays;  
	}

	//For setting session variables at the login
	/*function set_session($typedusername) {
		$userdata = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username='$typedusername'"));
		$_SESSION['user_id'] = $userdata['id'];
		$_SESSION['admin'] = $userdata['admin'];
		$_SESSION['teacher'] = $userdata['teacher'];
		$_SESSION['club'] = $userdata['club'];
		$_SESSION['sports'] = $userdata['sports'];
		$_SESSION['username'] = $typedusername;
	}*/

	function returnDaytype() {//stolen code, snips, snails, puppy dog tails, etc
		global $db;
		$query4 = "SELECT value FROM misc WHERE name='start_date'";
		$query5 = "SELECT value FROM misc WHERE name='end_date'";
		$select_Start= $db->runQuery($query4);
		$select_End = $db->runQuery($query5);
		
			$betterStartDate = $select_Start[0]['value'];
			$betterEndDate = $select_End[0]['value'];
			
			
		$abDays = GetDays($betterStartDate,$betterEndDate); //marks all days between yay and yay as "school days"
	$schoolDays = array();
	$query = "SELECT * FROM misc WHERE name='excluded_dates'";
	$xDatesPressed = $db->runQuery($query);
	$xDates = explode(",",$xDatesPressed[0]['value']);
				
				
		for($i=0;$i<count($abDays);$i++) { //your standard for loops
			$day=strftime("%A",strtotime($abDays[$i])); //gives an actual day instead of a numerical date
			if($day != "Saturday" && $day != "Sunday" && !in_array($abDays[$i],$xDates) ) { //sets sats and suns to not be pushed
				array_push($schoolDays,$abDays[$i]);
				}}
		$ABN = "N";
		//$today = date("Y-m-d");
		$today = "2014-04-17";
		for($i=0;$i<count($schoolDays);$i++) {
			if($today == $schoolDays[$i]) {
				if($i%2 == 0) {
					$ABN = "A";
				} else if($i%2 == 1) {
					$ABN = "B";
				}
			}
		}
		//echo $ABN;
		if($ABN){
			$query9 = "UPDATE misc SET value = '$ABN' WHERE name = 'currentDay'";
			$db -> runQuery($query9); }
		
		}
	
	//echo "<h2>".returnDaytype()."<h2>";
	
	
	function set_cookie_session(){
		$user_id = $_SESSION['user_id'];
		$query = "SELECT * FROM users WHERE id='$user_id'";
		$result = mysql_query($query);
		$userdata = array();
		while ($rows = mysql_fetch_array($result)) { 
			$userdata[] = $rows;
		}
		//$userdata = mysql_fetch_array(mysql_query($query));
		$_SESSION['teacher'] = $userdata[0]['teacher'];
		$_SESSION['club'] = $userdata[0]['club'];
		$_SESSION['sports'] = $userdata[0]['sports'];
		$_SESSION['admin'] = $userdata[0]['admin'];
				
}	
	function enforce_log() {
		if(!isset($_SESSION['user_id'])) {
			check_cookie();
		}else{ set_cookie_session();
		}
	}
	
	function make_cookie() {
		$expire = time()+(60*60*24*150);
		setcookie("staylogged", $_SESSION['user_id'], $expire);
	}
	
	function check_cookie() {
		if(isset($_COOKIE['staylogged'])) {
			$_SESSION['user_id']= $_COOKIE['staylogged'];
			set_cookie_session();
			header('Location: main.php?current=1');
		}else{
			header('Location: login.php');
			//echo "<h1>There is no spoon.</h1>";
		}
	}
	
	function delete_cookie() {
		$expire = time()-1;
		setcookie("staylogged", $_SESSION['user_id'], $expire);
	}
	
	function kLA() {
		if(isset($_POST['staylogged'])){
			make_cookie();
		}else{
			delete_cookie();
		}
	}
	
	function assist_log(){
		if(isset($_COOKIE['staylogged'])){
			header('Location: main.php?current=1');
		}
	}

	
				
	
?>