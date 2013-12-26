<?php
header('Content-Type: image/jpeg');
require_once("CollageMaker.class.php");
require_once("Image.model.php");

// /**
// **	Function gets all images wich are in landscape.
// **/
// function getImageListings($dir = "/Users/jw/picturesss/*.JPG"){
// 	$landscapeImages = array();
// 	$portraitImages = array();
// 	foreach (glob($dir) as $jpg)
// 	{
// 		list($width, $height) = getimagesize($jpg); // See PHP manual
// 		if($width > $height){
// 			$landscapeImages[] = $jpg;
// 		} else {
// 			$portraitImages = $jpg;
// 		}
// 	}
// 	shuffle($landscapeImages);
// 	return array (CollegeMaker::LANDSCAPE => $landscapeImages, CollegeMaker::PORTRAIT => $portraitImages);
// }

// function createBackgroundImage(){
// 	$image = imagecreatetruecolor(1920, 1080);
// 	imagefill($image, 0, 0, imagecolorallocate($image, 8, 232, 222));
// 	return $image;
// }

// function rand_bool($chance = 50) {
//    return (rand(1,100) <= $chance);
// }

// function fillImageWithImages(){
// 	$image = createBackgroundImage();
// 	list($landscape, $portrait) = getImageListings();

// 	// Upper corner left
// 	$currentImage = imagecreatefromjpeg($landscape[0]);
// 	list($width, $height) = getimagesize($landscape[0]);
// 	imagecopyresampled($image, $currentImage, 0, 0, 0, 0, 1920/2, 1080/2, $width, $height);
// 	imagedestroy($currentImage);

// 	// Upper corner right
// 	$currentImage = imagecreatefromjpeg($landscape[1]);
// 	list($width, $height) = getimagesize($landscape[1]);
// 	imagecopyresampled($image, $currentImage, 1920/2, 0, 0, 0, 1920/2, 1080/2, $width, $height);
// 	imagedestroy($currentImage);

// 	// Low corner left
// 	$currentImage = imagecreatefromjpeg($landscape[2]);
// 	list($width, $height) = getimagesize($landscape[2]);
// 	imagecopyresampled($image, $currentImage, 0, 1080/2, 0, 0, 1920/2, 1080/2, $width, $height);
// 	imagedestroy($currentImage);

// 	// Low corner right
// 	$currentImage = imagecreatefromjpeg($landscape[3]);
// 	list($width, $height) = getimagesize($landscape[3]);
// 	imagecopyresampled($image, $currentImage, 1920/2, 1080/2, 0, 0, 1920/2, 1080/2, $width, $height);
// 	imagedestroy($currentImage);


// 	// for($i = 0; $i < 4; $i++){
// 	// 	list($width, $height) = getimagesize($ls);
// 	// 	$dest_w = $width;
// 	// 	$dest_y = $height;
// 	// 	$ls_x (rand_bool());
// 	// 	$ls_y += 10;
// 	// 	$currentImage = imagecreatefromjpeg($ls);
// 	// 	imagecopyresampled($image, $currentImage, $ls_x, $ls_y, 0, 0, $dest_w, $dest_y, $width, $height);
// 	// 	imagedestroy($currentImage);
// 	// }
// 	return $image;
// }


$collageMaker = new CollageMaker();
imagejpeg($collageMaker->generateImage());

?>