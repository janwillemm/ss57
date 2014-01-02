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

	function __construct(){
		parent::__construct();
		$this->needsOwl = true;
	}
}

class PastEventSlide extends Slide{
	public $images;

	function __construct(){
		parent::__construct();
		$this->needsOwl = true;
	}
}

class FullScreenImageSlide extends Slide{
	public $imageBlock;

	function __construct($imageBlock){
		parent::__construct();
		$this->imageBlock = $imageBlock;
	}
}

class StatisticsSlide extends Slide{
	public $dataArray;
	public $body;
	public $title;
	public $xAxis;
	public $yAxis;
	public $imageUrl;

	function __construct(){
		parent::__construct();
		$this->needsOwl = true;
	}
}

class CustomHtmlSlide extends Slide{
	public $customHtml;
}




?>