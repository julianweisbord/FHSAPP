<?php 
	//For all your error needs
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
	function set_session($typedusername) {
		$userdata = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username='$typedusername'"));
		$_SESSION['user_id'] = $userdata['id'];
		$_SESSION['admin'] = $userdata['admin'];
		$_SESSION['teacher'] = $userdata['teacher'];
		$_SESSION['club'] = $userdata['club'];
		$_SESSION['sports'] = $userdata['sports'];
		$_SESSION['username'] = $typedusername;
	}

	function enforce_log() {
		if(!isset($_SESSION['user_id'])) {
			header('Location: login.php');
			exit();
		}
	}	

?>