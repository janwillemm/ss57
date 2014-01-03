<?php

class SlideGenerator implements ISlideGenerator{

	public static function generateSlides(){
		$slides = array();

		$staticSlides = StaticSlideGenerator::generateSlides();
		$CHSiteSlides = CHSiteSlideGenerator::generateSlides();

		$slides = array_merge($CHSiteSlides, $staticSlides);
		
		shuffle($slides);
		return $slides;
	}
}

?>