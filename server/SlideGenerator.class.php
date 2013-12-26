<?php

class SlideGenerator implements ISlideGenerator{

	public static function generateSlides(){
		$differentSlides = array();
		$CHSiteSlides = CHSiteSlideGenerator::generateSlides();
		return $CHSiteSlides;
	}
}

?>