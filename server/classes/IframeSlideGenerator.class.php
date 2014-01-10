<?php
class IframeSlideGenerator implements ISlideGenerator{
	

	public static function generateSlides(){
		$slides = array();
		$slides[] = self::generateWispoSlide();
		return $slides;
	}

	public static function generateWispoSlide(){
		$slide = new IframeSlide();
		$slide->title = "Wispo";
		$slide->src="slides/wispo/index.php";
		$slide->renewTime = "2";

		return $slide;
	}

}

?>