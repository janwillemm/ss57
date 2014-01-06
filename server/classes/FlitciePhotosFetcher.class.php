<?php

class FlitciePhotosFetcher{
	public static $allRegex = "/var\/(?P<size>albums|thumbs|resizes)\/([^.]*\.(jpg|jpeg))/i"; // (https:\/\/flitcie\.ch\.tudelft\.nl\/)?
	public static $nextRegex = "/\?page=([0-9]+)/";

	public static function fetchPhotos($url){
		$photos = array();

		// Get the first page
		$album = self::fetchPage($url);

		// Check how much pages there are
		$pages =  preg_match_all(self::$nextRegex, $album, $pages) ? array_unique($pages[1]) : array(1);
		for($page = 1; $page <= max($pages); $page++) {
		        $data = $page == 1 ? $album : self::fetchPage($page);
		        if(preg_match_all(self::$allRegex, $data, $matches)){
		                $photos = array_merge($photos, array_map(array('self', "addUrl"), $matches[2]));
		        }
		}

		return $photos;
	}

	private static function addUrl($photo){
		return "https://flitcie.ch.tudelft.nl/var/resizes/" . $photo;
	}

	private static function fetchPage($url, $page = 1){

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

}

// full: https://flitcie.ch.tudelft.nl/var/albums/56/Annuborrel/DSC01897.JPG?m=1369983944
// thumb:https://flitcie.ch.tudelft.nl/var/thumbs/56/Annuborrel/DSC01897.JPG?m=1369983945
// half: https://flitcie.ch.tudelft.nl/var/resizes/56/Annuborrel/DSC01897.JPG?m=1369983947



 

?>