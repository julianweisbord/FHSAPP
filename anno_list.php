<?php
header('content-type: application/json; charset=utf-8');

include('lib/config.php');
include('lib/db.class.php');
//include_once('functions.php'); 
$db = new Db($dbConfig); //boilerplate stuff

$entry_count=0;
$query1 = "SELECT * FROM announcements";
$announcements=$db->runQuery($query1);

/*$query2 = "SELECT * FROM anno_subtype";
$anno_subtype=$db->runQuery($query2);
$query3 = "SELECT * FROM subtype";
$subtypes=$db->runQuery($query3); */
//$query = "SELECT * FROM announcements INNER JOIN anno_subtype ON announcements.id = anno_subtype.anno_id WHERE anno_subtype.subtype_id = '$subtype_id'";
//	$announcements=$db->runQuery($query);

$entries=array();

foreach($announcements as $announcement) {
	$entry_count++;
	//yo it's a triple join-- please be impressed 
	$query1 = "SELECT type.name, type.id FROM type 
		INNER JOIN subtype
			ON type.id=subtype.type_id
		INNER JOIN anno_subtype
			ON subtype.id = anno_subtype.subtype_id
		INNER JOIN announcements
			ON anno_subtype.anno_id = announcements.id
		WHERE announcements.id = '{$announcement['id']}'";
	$category=$db->runQuery($query1); 
	array_push($entries,array(
		"catId"=>$announcement['id'],
		"title"=>$announcement['title'],
		"category"=>$category[0]['name'])
	);
}

$query = "SELECT * FROM type";   //grabs the types
$types=$db->runQuery($query);
$allcats=array();      //puts the types forcefully into an array
foreach($types as $type){  
	//echo "<p>{$type['name']}</p>";
	array_push($allcats, //places that array into an array
		$type['name']  //sets the name to match our 
	);
}

$query = "SELECT * FROM users WHERE teacher='1'"; //grabs the users by the shoulders
$teachers =$db->runQuery($query);
$allteachers=array(); 
foreach($teachers as $teacher){
	array_push($allteachers, $teacher['last_name'].", ".$teacher['first_name']);
}

$query = "SELECT value FROM misc WHERE name='SurveyUrl'";
$surveyUrl=$db->runQuery($query);
$surveyUrl = $surveyUrl[0]["value"];

$massive_array=array(  //a massive array full of everything good
		
		"feed"=>array(
			"entries"=>$entries, 
			"entryCount"=>$entry_count
		),
		"allcats"=>$allcats,
		"allteachers"=>$allteachers,
		"surveyUrl"=>$surveyUrl		
		); 
/*echo "<pre>";
print_r($massive_array); //--better for testing
echo "</pre>"; */

$callback = $_GET["callback"]; //?Dis be broke yo. Methinks you needs to actually set this when calling it. Maybe just hardcode it yo -Dustin

//?Be feelin' like dis be all wack too yo. -Dustin
// dynamically determine if JSON or JSONP is being used
if ( isset($_GET['callback']) ) echo "{$_GET['callback']}(";

echo json_encode($massive_array); //final product

// dynamically determine if JSON or JSONP is being used
if ( isset($_GET['callback']) ) echo ")";

?>
