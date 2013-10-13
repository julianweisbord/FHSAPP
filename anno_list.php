<?php
include('lib/config.php');
include('lib/db.class.php');
//include_once('functions.php');
$db = new Db($dbConfig);
$user_id = "1";
$query = "SELECT * FROM announcements WHERE author='$user_id'";
$announcements=$db->runQuery($query);

foreach($announcements as $announcement) {
	//echo "<p> {$announcement['description']}</p>";

}

$query = "SELECT * FROM type";
$types=$db->runQuery($query);
$allcats=array();
foreach($types as $type){
	//echo "<p>{$type['name']}</p>";
	array_push($allcats,array(
		"title"=>$type['name']
	
	));
}
$massive_array=array(
	"feed"=>array(
		"allcats"=>$allcats
		)
	);
//print_r($massive_array);
echo json_encode($massive_array);
?>
