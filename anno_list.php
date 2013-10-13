<?php
include('lib/config.php');
include('lib/db.class.php');
//include_once('functions.php'); 
$db = new Db($dbConfig); //boilerplate stuff



$query = "SELECT * FROM announcements";
$announcements=$db->runQuery($query);


$entries=array();
foreach($announcements as $announcement) {
	array_push($entries,array("catId"=>$announcement['id']));	
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
