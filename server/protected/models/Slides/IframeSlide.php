<?php
class IframeSlide extends Slide{
	public $title;
	public $src;
	public $renewTime;

	function __construct(){
		parent::__construct();
		$this->needsOwl = true;
	}
}
?>