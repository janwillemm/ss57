<?php

class SlideGenerator implements ISlideGenerator{

	public static function generateSlides(){
		$slides = array();

		//$staticSlides = DatabaseSlideGenerator::generateSlides();
		$CHSiteSlides = CHSiteSlideGenerator::generateSlides();

		$slides = array_merge($slides, $staticSlides);
		
		shuffle($slides);
		return $slides;
	}
}

?>