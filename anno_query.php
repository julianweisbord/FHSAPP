<?php
include('lib/config.php'); //having a database connection is a good idea
include('lib/db.class.php');
//include_once('functions.php'); "it comes standard"
$db = new Db($dbConfig); //boilerplate stuff FOR PACHAHUTI


$massive_array_dos = array(); //Bak'tun based array
$catids = explode(',', $_REQUEST['catids']); //sacrifical captives were made of the catids, their individual strings quartered at each comma
//PRINT_R($catids); //temporary ceremonial display pyramid

$feedUrl ="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  //seedlings to quetzalcoatl 
array_push($massive_array_dos, array("feedUrl"=>$feedUrl));  

$query= "SELECT * FROM subtype where $catids=subtype.id";
$catidz=$db->runQuery($query);
var_dump($query);





 $massive_array_dos=array( //where everything goes quando quetzal returns
	"feeds"=>array( //commented out stuff is being worked on, stored temp. in mystic granaries
		"feedUrl"=>$feedUrl,
		"entries"=>array(
			/*"title"=>$title,
			"id"=>$id,
			"summary"=>$summary,
			"content"=>$content,
			"startDate"=>$startdate,
			"expirationDate"=>$expdate,
			"eventDate"=>$eventdate,
			"eventTime"=>$eventtime,
			"eventLocation"=>$eventloc,
			"author"=>$auth,
			"topCategory"=>$topcat,
			"category"=>$cat,
			"catId"=>$catidz 
		"feeds"=>array(
			"title"=$feedstitle,
			"catId"=$feedscatidz,
			topCategory=$feedstopcat  */
			
		)
	)
);		



echo"<pre>"; 
PRINT_R($massive_array_dos); //transfers data from spirit world --> our world
echo"</pre>"; //pre cannot be used for json transcription, vardump or something has to be used l8r
?>
