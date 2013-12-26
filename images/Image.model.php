<?php

class CollageImage{
	public $imageLocation;
	public $width;
	public $height;

	function __construct($loc){
		$this->imageLocation = $loc;
		list($w, $h) = getimagesize($loc);
		$this->width = $w;
		$this->height = $h;
	}
	function isLandscape(){
		return $this->width > $this->height;
	}

	function getJPEGImage(){
		return imagecreatefromjpeg($this->imageLocation);;
	}
}

?>