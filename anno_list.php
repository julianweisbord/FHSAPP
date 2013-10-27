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
		$query = "SELECT * FROM subtype INNER JOIN anno_subtype ON subtype.id = anno_subtype.subtype_id WHERE anno_id = '{$announcement['id']}'";
		$subtype=$db->runQuery($query);
		array_push($annoData,array("category"=>$subtype['name']));
		//array_push($annoData,array("feedUrl"=>$announcement['feedurl'])); -- this doesn't exist yet. 
		//foreach($subtypes as $subtype){
			//array_push($annoData,array("category"=>$subtype['id'])); -- failed teratomas of evil code
	array_push($entries,$annoData);
	
 
}


$query = "SELECT * FROM type";   //grabs the types
$types=$db->runQuery($query);
$allcats=array();      //puts the types forcefully into an array
foreach($types as $type){  
	//echo "<p>{$type['name']}</p>";
	array_push($allcats,array( //places that array into an array
		"title"=>$type['name']  //sets the name to match our 
	
	));
}


$massive_array=array(  //a massive array full of everything good
	"feed"=>array(
		"entries"=>$entries, 
		"allcats"=>$allcats
		
		)
	);
echo "<pre>";
print_r($massive_array); //--better for testing
echo "</pre>";
//echo json_encode($massive_array); //final product

?>
