<?php
class IframeSlideGenerator implements ISlideGenerator{


	public static function generateSlides(){
		$slides = array();
		//$slides[] = self::generateWispoSlide();
		//$slides[] = self::generateBootfeestSlide();
		$slides[] = self::generateIComSlide();
		return $slides;
	}

	public static function generateBootfeestSlide(){
		$slide = new IframeSlide();
		$slide->src = "slides/bootfeest/index.php";
		return $slide;
	}

	public static function generateWispoSlide(){
		$slide = new IframeSlide();
		$slide->title = "Wispo";
		$slide->src="slides/wispo/index.php";
		$slide->renewTime = "2";

		return $slide;
	}

	public static function generateIComSlide(){
		$slide = new IframeSlide();
		$slide->title = "iCom";
		$slide->src="slides/icom/icom.html";
		return $slide;
	}

}

?>
