<?php
include('lib/config.php');
include('lib/db.class.php');
//include_once('functions.php'); 
$db = new Db($dbConfig); //boilerplate stuff



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
	$annoData = array();
		array_push($annoData,array("catId"=>$announcement['id']));
		array_push($annoData,array("title"=>$announcement['title']));
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
		array_push($annoData,array("category"=>$category[0]['name']));
		
	array_push($entries,$annoData);
	
 
}


$query = "SELECT * FROM type";   //grabs the types
$types=$db->runQuery($query);
$allcats=array();      //puts the types forcefully into an array
foreach($types as $type){  
	//echo "<p>{$type['name']}</p>";
	array_push($allcats,array( //places that array into an array
		$type['name']  //sets the name to match our 
	
	));
}

$query = "SELECT * FROM users WHERE teacher='1'"; //grabs the users by the shoulders
$teachers =$db->runQuery($query);
$allteachers=array(); 
foreach($teachers as $teacher){
	array_push($allteachers,array(
	$teacher['last_name'].", ".$teacher['first_name']
	));
}

$query = "SELECT value FROM misc WHERE name='SurveyUrl'";
$surveyUrl=$db->runQuery($query);
$surveyUrl = $surveyUrl[0]["value"];

		


$massive_array=array(  //a massive array full of everything good
	"feed"=>array(
		"entries"=>$entries, 
		"allcats"=>$allcats,
		"allteachers"=>$allteachers,
		"surveyUrl"=>$surveyUrl		
		)
	);
/*echo "<pre>";
print_r($massive_array); //--better for testing
echo "</pre>"; */
echo json_encode($massive_array); //final product

?>
