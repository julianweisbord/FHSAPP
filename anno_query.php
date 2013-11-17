<?php
$massive_array_dos = array();
//Bak'tun based array
$catids = explode(',', $_REQUEST['catids']); //sacrifical captives were made of the catids, their individual strings quartered at each comma
//PRINT_R($catids); //temporary ceremonial display pyramid

$feedUrl ="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  //seedlings to quetzalcoatl 
array_push($massive_array_dos, array("feedUrl"=>$feedUrl));







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
			"catId"=>$CATEMAGORIEOUSIDYLLIC,) 
		"feeds"=>array(
			"title"=$feedstitle,
			"catId"=$feedsCATEMAGORIEOUSIDYLLIC,
			topCategory=$feedstopcat  */
			
		)
	)
);		



echo"<pre>";
PRINT_R($massive_array_dos);
echo"</pre>";
?>
