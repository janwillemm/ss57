<?php
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
?>