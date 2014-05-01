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
?>