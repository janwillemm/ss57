<?php
class StaticSlideGenerator implements ISlideGenerator{

	public static function generateSlides(){
		$slides = array();
		$slides = array_merge($slides, self::makeFactSlides());
		
		return $slides;
	}

	private static function makeFactSlides(){
		$slides = array();
		foreach(self::facts() as $fact){
			$slide = new FactSlide();
			$slide->title = "Wist je dat";
			$slide->fact = $fact;
			$slides[] = $slide;
		}
		return $slides;
	}

	private static function facts(){
		$facts = array();
		$facts[] = "Je alle quotes naar quotes@ch.tudelft.nl kunt sturen? Dan worden ze wellicht in het Annuarium geplaatst!";
		$facts[] = "Bestuur 57 ook in de kerstvakantie hard heeft doorgewerkt om voor het ledencomfort te zorgen?";
		$facts[] = "Bestuur 57 iedereen een gelukkig nieuwjaar wenst?";
		return $facts;
	}
}

?>