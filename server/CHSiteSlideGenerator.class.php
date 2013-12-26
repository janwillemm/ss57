<?php
class CHSiteSlideGenerator implements ISlideGenerator{
	
	const urlRegex = "/[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/i";
	const flitcieRegex = "/https:\/\/flitcie\.ch\.tudelft\.nl\/([0-9]{1,3})\/([a-zA-Z0-9\-]+)/i";
	const API = "https://ch.tudelft.nl/api/tv/all.jsonp";
	const flitcieAPI = "fetchFlitciePhotos.php";
	const posterRegex = '/https:\/\/ch\.tudelft\.nl\/sites\/default\/files\/[^"]+/';

	// singleton instance 
	private static $instance; 

	// private constructor function 
	// to prevent external instantiation 
	private __construct() { } 

	// getInstance method 
	public static function getInstance() { 
		if(!self::$instance) { 
			self::$instance = new self(); 
		}
		return self::$instance; 
	} 

	public static function generateSlides(){
		$instance = self::getInstance();
		$instance->fetchData();
	}

	public function fetchData(){
		$data = file_get_contents(self::API);
		$items = json_decode($data);
		array_map("parseItem", $items);
	}

	public function parseItem($item){
		
	}
}

?>