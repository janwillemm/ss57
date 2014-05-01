<?php
class PastEventSlide extends Slide{
	public $images;

	function __construct(){
		parent::__construct();
		$this->needsOwl = true;
		$this->time = 10;
	}
}
?>