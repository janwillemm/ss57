<?php
class FullScreenImageSlide extends Slide{
	public $imageBlock;

	function __construct($imageBlock){
		parent::__construct();
		$this->imageBlock = $imageBlock;
		$this->time = 30;
	}
}
?>