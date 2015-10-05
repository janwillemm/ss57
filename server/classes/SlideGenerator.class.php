<?php

class SlideGenerator implements ISlideGenerator{

	public static function generateSlides(){
		$slides = array();

		//$staticSlides = DatabaseSlideGenerator::generateSlides();
		//$slides = array_merge($slides, $staticSlides);

		$CHSiteSlides = CHSiteSlideGenerator::generateSlides();
		$slides = array_filter(array_merge($slides, $CHSiteSlides));;

		$iframeSlides = IframeSlideGenerator::generateSlides();
		$slides = array_merge($slides, $iframeSlides);
		
		shuffle($slides);
		return $slides;
	}
}

?>
