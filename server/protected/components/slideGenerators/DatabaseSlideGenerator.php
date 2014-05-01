<?php 
class DatabaseSlideGenerator implements ISlideGenerator{
	
	public static function generateSlides(){
		$slides = array();
		$slides = array_merge($slides, self::makeFactSlides());
		$slides = array_merge($slides, self::makeQuoteSlides());
		$slides = array_merge($slides, self::makeFlitcieSlides());
		
		return $slides;
	}

	private static function makeFactSlides(){
		$slides = array();
		
		$facts = Fact::model()->findAll("active = :active", array(":active" => true));

		foreach($facts as $fact){
			$slide = new FactSlide();
			$slide->title = "Wist je dat...";
			$slide->fact = "..." . $fact->fact;
			$slides[] = $slide;
		}
		
		return $slides;
	}

	private static function makeQuoteSlides(){
		$slides = array();

		$quotes = Quote::model()->findAll("active = :active", array(":active" => true));

		foreach($quotes as $quote){
			$slide = new FactSlide();
			$slide->title = "Quote";
			$slide->fact = $quote->quote;
			$slide->name = $quote->author;
			$slides[] = $slide;
		}
		return $slides;
	}

	private static function makeIframeSlides(){
		$slides = array();

		//$iframes = 
	}

	private static function makeFlitcieSlides(){
		$slides = array();

		$events = self::getEvents();

		$slides = array_map('self::makeFlitcieSlide', $events);
		
		return $slides;
	}

	private static function makeFlitcieSlide($event){
		$pictures = self::getPhotosForEvent($event);
		$imageUrls = self::parseImageUrls($pictures);

		$slide = new PastEventSlide();
		$slide->images = $imageUrls;
		$slide->title = $event['name'];
		return $slide;
	}

	private static function parseImageUrls($flitcieItems){
		$imageUrls = array();
		foreach($flitcieItems as $flitcieItem){
			$imageUrls[] = "https://flitcie.ch.tudelft.nl/var/resizes/" . $flitcieItem->relative_path_cache;
		}
		return $imageUrls;
	}

	private static function getEvents(){
		$lectureWeeks = self::checkInt(1);
		$eventWeeks = self::checkInt(4);
		$result = Yii::app()->dbFlitcie->createCommand()
			->select(array('id', 'name'))
			->from('items')
			->where(
				array(
					'and', 
					'type=\'album\'', 
					array(
						'or', 
						array(
							'and', 
							'created > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL ' . $lectureWeeks . ' WEEK))', 
							array('like', 'name', '%unchlezing%')
						),
						array(
							'and',
							'created > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL ' . $eventWeeks . ' WEEK))', 
							array('not like', 'name', '%unchlezing%')
						)	
					)
				)
			)
			->queryAll();
		return $result;
	}

	private static function getPhotosForEvent($event){
		$results = FlitcieItem::model()->findAll("parent_id = :event_id AND type = :type", array(":event_id" => $event['id'], ":type" => "photo"));
		return $results;
	}


	private static function checkInt($int){
		$newInt = intVal($int);
		$maxInt = 10;
		if($newInt <= 0){
			$newInt = 1;
		}
		if($newInt > $maxInt){
			$newInt = $maxInt;
		}

		return (int) $newInt;
	}
}


?>