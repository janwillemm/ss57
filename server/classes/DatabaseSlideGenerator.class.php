<?php 
class DatabaseSlideGenerator implements ISlideGenerator{
	
	public static function generateSlides(){
		$slides = array();
		$slides = array_merge($slides, self::makeFactSlides());
		
		return $slides;
	}

	private static function makeFactSlides(){
		$slides = array();
		$dbc = DatabaseConnection::getInstance();
		$factElements = $dbc->getAll($dbc->DBNAME_FACTS);

		foreach($factElements as $factElement){
			$slide = new FactSlide();
			$slide->title = "Wist je dat...";
			$slide->fact = "..." . $factElement['fact'];
			$slides[] = $slide;
		}
		return $slides;
	}

	private static function makeQuoteSlides(){
		$slides = array();
		$dbc = DatabaseConnection::getInstance();
		$factElements = $dbc->getAll($dbc->DBNAME_QUOTES);

		foreach($factElements as $factElement){
			$slide = new FactSlide();
			$slide->title = "Wist je dat...";
			$slide->fact = "..." . $factElement['quote'];
			$slide->name = "..." . $factElement['person'];
			$slides[] = $slide;
		}
		return $slides;
	}
}


?>