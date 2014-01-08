<?php
require_once("autoLoader.php");
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

$dbc = DatabaseConnection::getInstance();

$setting = $dbc->getSetting("reload");

if($setting['value'] == "true"){
	echo json_encode(array("type"=> "refreshAllSlides"));
	$dbc->updateSetting("reload", "false");
}
?>