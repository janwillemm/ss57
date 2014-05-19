<?php
class Slide {
	private $needsOwl;
	public $title;
	public $time; // in seconds

	function __construct(){
		$this->needsOwl = false;
		$this->time = 10;
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
		$this->time = 10;
	}
}

class FullScreenImageSlide extends Slide{
	public $imageBlock;

	function __construct($imageBlock){
		parent::__construct();
		$this->imageBlock = $imageBlock;
		$this->time = 30;
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

class FactSlide extends Slide{
	public $fact;
	public $name;

	function __construct(){
		parent::__construct();
		$this->needsOwl = true;
	}
}

class IframeSlide extends Slide{
	public $title;
	public $src;
	public $renewTime;

	function __construct(){
		parent::__construct();
		$this->needsOwl = false;
	}
}



?>
