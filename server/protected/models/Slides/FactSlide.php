<?php
class FactSlide extends Slide{
	public $fact;
	public $name;

	function __construct(){
		parent::__construct();
		$this->needsOwl = true;
	}
}
?>