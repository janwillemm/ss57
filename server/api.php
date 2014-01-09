<?php
require_once("autoLoader.php");
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

function l57($data){
	trigger_error($data, E_USER_WARNING);
}

function expose($slide){
	if($slide)
		return $slide->expose();
}

$slides = SlideGenerator::generateSlides();

echo json_encode(array_map("expose", $slides));

?>