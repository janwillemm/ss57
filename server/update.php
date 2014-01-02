<?php
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

die();
$slide = new StatisticsSlide();
$slide->dataArray = array(	)
echo json_encode(array("type"=> "refreshAllSlides", "slide" => ));
?>