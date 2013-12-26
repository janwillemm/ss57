<?php
	
$root = "https://flitcie.ch.tudelft.nl/";
if(strpos($_GET['url'], $root) === 0)
	$url = $_GET['url'];
else 
	$url = $root . $_GET['url'];


// full: https://flitcie.ch.tudelft.nl/var/albums/56/Annuborrel/DSC01897.JPG?m=1369983944
// thumb:https://flitcie.ch.tudelft.nl/var/thumbs/56/Annuborrel/DSC01897.JPG?m=1369983945
// half: https://flitcie.ch.tudelft.nl/var/resizes/56/Annuborrel/DSC01897.JPG?m=1369983947
$regex = array(
	"all" => "/var\/(?P<size>albums|thumbs|resizes)\/([^.]*\.(jpg|jpeg))/i", // (https:\/\/flitcie\.ch\.tudelft\.nl\/)?
	"next" => "/\?page=([0-9]+)/"
);

function get($page = 1){
	global $url;

	$ch = curl_init($url . "?page=$page");
	curl_setopt ( $ch , CURLOPT_RETURNTRANSFER , 1 );
	
	$out = curl_exec($ch);
	
	if (curl_errno($ch))  
	{
		return false;
	} 
	curl_close($ch); //Sluit de link met de website
	return $out;
}
 
$photos = array();

$album = get();

$pages =  preg_match_all($regex['next'], $album, $pages) ? array_unique($pages[1]) : array(1);
for($page = 1; $page <= max($pages); $page++) {
	$data = $page == 1 ? $album : get($page);
	if(preg_match_all($regex['all'], $data, $matches)){
		$photos = array_merge($photos, $matches[2]);


	}
}

?><!DOCTYPE html>
<html>
	<head>
		<script src="shiftingtiles.build/jquery-1.8.3.js"></script>
		<script src="shiftingtiles.build/shiftingtiles.js"></script>
		<link rel="stylesheet" type="text/css" href="shiftingtiles.build/shiftingtiles.css">
	</head>
	<body>
		<div class="gallery"></div>
		<script>
			$(".gallery").shiftingtiles(function get_photos(){
				return <?php echo json_encode($photos); ?>.map(function(url){
					return "https://flitcie.ch.tudelft.nl/var/resizes/" + url;
				});
			}());
		</script>
	</body>
</html>
