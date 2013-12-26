<?php
class Slide {
	private $needsOwl;
	public $title;

	function __construct(){
		$this->needsOwl = false;
	}
	function expose(){
		$object = get_object_vars($this);
		$returnValue = array("type" => get_class($this), "slide" => $object);
		return $returnValue;
	}

	function hasTitle($title){
		$this->needsOwl = true;
		$this->title = $title;
	}
}

class UpcomingEventSlide extends Slide{
	public $readableDate;
	public $desc;
	public $imageUrl;
	public $price;
	public $location;
}

class PastEventSlide extends Slide{
	public $images;
}

class FullScreenImageSlide extends Slide{
	public $imageBlock;

	function __construct($imageBlock){
		parent::__construct();
		$this->imageBlock = $imageBlock;
	}
}





?>