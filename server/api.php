<?php
require_once("Slide.class.php");
require_once("ISlideGenerator.interface.php")
require_once("SlideGenerator.class.php");
require_once("CHSiteSlideGenerator.class.php");
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

function expose($slide){
	return $slide->expose();
}

$slides = SlideGenerator::getSlides();
echo array_map("expose", $slides);

?>