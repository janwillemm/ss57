<?php

class SlideGenerator implements ISlideGenerator{

	

	private static $instance;

	private __construct() {};

	public static function getInstance(){
		if(!self::$instance) { 
	    	self::$instance = new self(); 
		} 
    	return self::$instance; 
	}

	public static function generateSlides(){
		$instance = self::getInstance();
		$instance->
	}


	

}

?>