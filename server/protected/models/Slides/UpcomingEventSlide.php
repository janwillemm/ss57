<?php
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
?>