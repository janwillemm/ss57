<?php
require_once("login.php");

$dcon = new DatabaseConnection();
$urls = array(
	"https://flitcie.ch.tudelft.nl/var/resizes/57/Lunchlezing-Portolan-Charts/DSC07341.JPG",
	"https://flitcie.ch.tudelft.nl/var/resizes/57/Lunchlezing-Portolan-Charts/DSC07344.JPG",
	"https://flitcie.ch.tudelft.nl/var/resizes/57/Lunchlezing-Portolan-Charts/DSC07345.JPG",
	"https://flitcie.ch.tudelft.nl/var/resizes/57/Lunchlezing-Portolan-Charts/DSC07346.JPG",
	"https://flitcie.ch.tudelft.nl/var/resizes/57/Lunchlezing-Portolan-Charts/DSC07347.JPG",
	"https://flitcie.ch.tudelft.nl/var/resizes/57/Lunchlezing-Portolan-Charts/DSC07343.JPG"
);
$dcon->setImageUrlsForEventId($urls, 1);
var_dump($dcon->getImageUrlsForEventId(1));

?>