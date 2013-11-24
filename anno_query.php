<?php
include('lib/config.php'); //having a database connection is a good idea
include('lib/db.class.php');
//include_once('functions.php'); "it comes standard"
$db = new Db($dbConfig); //boilerplate stuff FOR moctezuma


$massive_array_dos = array(); //Bak'tun based array
$entries = array();
$catids = explode(',', $_REQUEST['catids']); //sacrifical captives were made of the catids, their individual strings quartered at each comma
//PRINT_R($catids); //temporary ceremonial display pyramid

$feedUrl ="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  //seedlings to quetzalcoatl 
array_push($massive_array_dos, array("feedUrl"=>$feedUrl));


foreach($catids as $catid){
	$annoData = array();
	$query1="SELECT * FROM announcements
			INNER JOIN anno_subtype
				ON announcements.id = anno_subtype.anno_id
			WHERE anno_subtype.subtype_id = $catid";
	$annos=$db->runQuery($query1); 
	//var_dump($annos); LAME
		foreach($annos as $anno) {
			$query2="SELECT users.first_name, users.last_name, users.id FROM users
					INNER JOIN announcements
						ON users.id = announcements.author
					WHERE announcements.id = {$anno['id']}";
			
			array_push($annoData,array("title"=>$anno['title']));
	
		}
	
	
		array_push($entries,$annoData);
}

array_push($massive_array_dos,$entries);


 /*$massive_array_dos=array( //where everything goes quando quetzal returns
	"feeds"=>array( //commented out stuff is being worked on, stored temp. in mystic granaries
		"feedUrl"=>$feedUrl,
		"entries"=>array(
			"title"=>$title, may be replaced entirely with annodata
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
			topCategory=$feedstopcat  
			
		)
	)
);		*/



echo"<pre>"; 
PRINT_R($massive_array_dos); //transfers data from spirit world --> our world
echo"</pre>"; //pre cannot be used for json transcription, vardump or something has to be used l8r
?>
