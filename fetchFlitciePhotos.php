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

// Get the first page
$album = get();

// Check how much pages there are
$pages =  preg_match_all($regex['next'], $album, $pages) ? array_unique($pages[1]) : array(1);
$numberOfPages = max($pages);

// Chose a random page to get photo's from (So we don't need to scrape all pages)
$randPage = rand(1,$numberOfPages);
if($randPage != 1){
	if($randPage == $numberOfPages){ // Can be the last page with less photos
		$album .= get($randPage); // So we take photos from both pages
	}
	else {
		$album = get($randPage);
	}
}
// Get the images
if(preg_match_all($regex['all'], $album, $matches)){
	$photos = array_merge($photos, $matches[2]);
}
//return the json with only 6 images
echo json_encode(array("length"=>count($photos), "photos"=>$photos));
?>