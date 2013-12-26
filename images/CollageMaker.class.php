<?php
function myLog($message){
	error_log($message, 0);
}

function rand_bool($chance = 50) {
   return (rand(1,100) <= $chance);
}

class collageMaker{
	
	private $finalImage;
	private $finalWidth = 1920;
	private $finalHeight = 1080;

	const LANDSCAPE = 'LANDSCAPE';
	const PORTRAIT = 'portrait';
	private $images;

	private $maxDepth = 5;

	function __construct(){
		$image = imagecreatetruecolor($this->finalWidth, $this->finalHeight);
		imagefill($image, 0, 0, imagecolorallocate($image, 8, 232, 222));
		$this->finalImage = $image;
		$images = array();
	}

	private function getImageListings($dir = "/Users/jw/picturesss/*.JPG"){
		$this->images[self::LANDSCAPE] = array();
		$this->images[self::PORTRAIT] = array();
		foreach (glob($dir) as $jpg)
		{
			 // See PHP manual
			$image = new CollageImage($jpg);
			if($image->isLandscape()){
				$this->images[self::LANDSCAPE][] = $image;
			} else {
				$this->images[self::PORTRAIT][] = $image;
			}
		}
		shuffle($this->images[self::LANDSCAPE]);
		shuffle($this->images[self::PORTRAIT]);

	}

	public function generateImage(){
		$this->getImageListings();
		$this->fillPartOfImage(0, 0, $this->finalWidth, $this->finalHeight, 3);
		return $this->finalImage;
	}

	public function fillPartOfImage($start_x, $start_y, $width, $height, $depth){
		$options[] = array('width' => $start_x, 			'height' => $start_y);
		$options[] = array('width' => $start_x, 			'height' => $start_y+$height/2);
		$options[] = array('width' => $start_x+$width/2, 	'height' => $start_y);
		$options[] = array('width' => $start_x+$width/2, 	'height' => $start_y+$height/2);

		if($depth == $this->maxDepth){
			if(count($this->images[self::LANDSCAPE])){
				if(rand_bool(25)){
					return $this->fillPartOfImageWithSingleImage($start_x, $start_y, $width, $height, self::LANDSCAPE);
				} else if(rand_bool(25) && count($this->images[self::PORTRAIT])){
					for($i = 0; $i < 2; $i++){
						$this->fillPartOfImageWithSingleImage($options[$i]['width'], $options[$i]['height'], $width/2, $height/2, self::LANDSCAPE);
					}
					return $this->fillPartOfImageWithSingleImage($options[3]['width'], $start_y, $width/2, $height, self::PORTRAIT);
				}
				else {
					for($i = 0; $i < 4; $i++){
						$this->fillPartOfImageWithSingleImage($options[$i]['width'], $options[$i]['height'], $width/2, $height/2, self::LANDSCAPE);
					}
				}
				return true;
			} else {
				return false;
			}
		}
		

		switch(count($this->images[self::LANDSCAPE])){
			case 0:
				return false;
			case 1:
			case 2:
			case 3: //Portrait opportunity 
				return $this->fillPartOfImageWithSingleImage($start_x, $start_y, $width, $height, self::LANDSCAPE);
			case 4:
				if(rand_bool(25)){
					return $this->fillPartOfImageWithSingleImage($start_x, $start_y, $width, $height, self::LANDSCAPE);
				} else if(rand_bool(25) && count($this->images[self::PORTRAIT])){
					for($i = 0; $i < 2; $i++){
						$this->fillPartOfImageWithSingleImage($options['width'], $options['height'], $width/2, $height/2, self::LANDSCAPE);
					}
					return $this->fillPartOfImageWithSingleImage($options['width'], $start_y, $width/2, $height, self::PORTRAIT);
				}
				else {
					for($i = 0; $i < 4; $i++){
						$this->fillPartOfImageWithSingleImage($options['width'], $options['height'], $width/2, $height/2, self::LANDSCAPE);
					}
				}
				return true;

			default:
				$state = true;
				$count = 0;
				while($state && $count < 4){
					myLog($count);
					$backupImages = $this->images;
					$state = $this->fillPartOfImage($options[$count]['width'], $options[$count]['height'], $width/2, $height/2, $depth+1);
					if(!$state)
						$this->images = $backupImages;
					$count++;
				}
				return $state;
		}

	}

	public function fillPartOfImageWithSingleImage($start_x, $start_y, $width, $height, $typeImage){
		$image = $this->getRandomImage($typeImage);
		if(!$image){
			return false;
		}
		imagecopyresampled($this->finalImage, $image->getJPEGImage(), $start_x, $start_y, 0, 0, $width, $height, $image->width, $image->height);
		return true;
	}


	public function getRandomImage($typeImage){
		if(empty($this->images[$typeImage]))
			return null;

		$index = array_rand($this->images[$typeImage]);
		$image = $this->images[$typeImage][$index];
		unset($this->images[$typeImage][$index]);

		return $image;
	}
}

?>