<?php
class CHSiteSlideGenerator implements ISlideGenerator{
	
	const urlRegex = "/[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/i";
	const flitcieRegex = "/https:\/\/flitcie\.ch\.tudelft\.nl\/([0-9]{1,3})\/([a-zA-Z0-9\-]+)/i";
	const API = "https://ch.tudelft.nl/api/tv/all.jsonp";
	const flitcieAPI = "fetchFlitciePhotos.php";
	const posterRegex = '/https:\/\/ch\.tudelft\.nl\/sites\/default\/files\/[^"]+/';

	const IMAGEFULLSCREEN = "image-fullscreen";

	// singleton instance 
	private static $instance; 

	// private constructor function 
	// to prevent external instantiation 
	private function __construct() { } 

	// getInstance method 
	public static function getInstance() { 
		if(!self::$instance) { 
			self::$instance = new self(); 
		}
		return self::$instance; 
	} 

	public static function generateSlides(){
		$instance = self::getInstance();
		return $instance->fetchData();
	}

	public function fetchData(){
		$data = file_get_contents(self::API);
		$items = json_decode($data);
		return array_map(array($this, "parseItem"), $items);
	}

	public function parseItem($item){
		// De eerste sortering geschied op event/ad
		switch($item->type){
			case "event":
				return $this->parseEvent($item);
				break;
			case "tv_item":
				return $this->slideForFullScreenImage($item);
				break;
			default:
				return;
		}
	}

	public function slideForFullScreenImage($item){
		$slide = new FullScreenImageSlide($item->{self::IMAGEFULLSCREEN});
		return $slide;
	}

	public function parseEvent($event){
		$hasPictures = preg_match(self::flitcieRegex, $event->body, $matches);
		if($hasPictures){
			return $this->parsePastEvent($event, $matches[0]);
		}
		return false;
	}

	public function parsePastEvent($event, $flitcieUrl){
		$flitciePhotos = FlitciePhotosFetcher::fetchPhotos($flitcieUrl);
		$slide = new PastEventSlide();
		$slide->hasTitle($event->title);
		$slide->images = $flitciePhotos;
		return $slide;
	}
}

?>