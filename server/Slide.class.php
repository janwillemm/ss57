<?php
class Slide {
	private var $needsOwl;
	public var $title;

	function __construct(){
		$this->needsOwl = false;
	}
	function expose(){
		$object = get_object_vars($this);
		$returnValue = array("type" => get_class($this), "slide" => $object);
		return $returnValue;
	}

	function setNeedsOwl($bool){
		$this->needsOwl = $bool;
	}
}

class UpcomingEventSlide extends Slide{
	public var $readableDate;
	public var $desc;
	public var $imageUrl;
	public var $price;
	public var $location;
}

class PastEventSlide extends Slide{
	public var $images;

	function PastEventSlide(){
		parent::__construct();
		$this->needsOwl = true;
	}
}

class FullScreenImageSlide extends Slide{
	public var $imageUrl;
}





?>