<?php 
class DatabaseSlideGenerator implements ISlideGenerator{
	
	public static function generateSlides(){
		$slides = array();
		$slides = array_merge($slides, self::makeFactSlides());
		$slides = array_merge($slides, self::makeQuoteSlides());
		
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
			$slide->name = $factElement['name'];
			$slides[] = $slide;
		}
		return $slides;
	}
}


?>