<?php

/**
 * @author Leroy Johnson
 * @copyright 2009
 * @purpose create a mosaic from photographs in a directory
 */

class buildMosaic
{
	var $dir		= '';
	var $outfile 	= '';	// set path and file name. The file is created automaticall by this script or replace if it exists
						    // set this to Null to allow output to the browser.
	var $quality 	= '';	// set the resolution
	var $sources 	= '';
	var $mos_x 	= 	1920;	 // set the width of the mosaic
	var $mos_y 	= 	1080;	// set the height of the mosaic
	
	/**
	 *  pass in all parameters needed to build mosaic 
	 */
	function __construct($dir,$outfile,$quality)
	{
		$this->dir 		= $dir;
		$this->outfile 	= $outfile;
		$this->quality	= $quality;
		self::getImages();
		
	}
	
	/**
	 * Creates an array of resource handles for all photos in the directory
	 */
	function getImages()
	{

		$sources = array();
		
		if (!is_dir($this->dir)) return $err = " please enter a valid directory"; 
		
		$dh = opendir($this->dir); 
		
		while (($file = readdir($dh)) !== false) 
		{
		   //echo "filename: $file : filetype: " . filetype($dir . "/". $file) . "\n";
		   	if(preg_match("/[.]JPG|jpg|JPEG|jpeg$/",$file) && $file != $this->outfile)
		   	{
		   		$filess = imagecreatefromjpeg($this->dir . "/" . $file);
		   		$sources[] = $filess;
		   	}
		}
		closedir($dh);
		$this->sources = $sources;
	}
	
	
	function makeMos()
	{	
		$x = 0;
		$y = 0;
		$index = 0;
		
		$im 	= imagecreatetruecolor($this->mos_x,$this->mos_y);
		while(true)
		{
			$width	= imagesx($this->sources[$index]); 
			$height = imagesy($this->sources[$index]);
			
			imagecopy($im,$this->sources[$index],$x,$y,0,0,$width,$height);
			$x += $width;
			if( $x >= $this-> mos_x)
			{//732 4232741 marlon
				$x = 0;
				$y += $height;
				next($this-> sources);
				if($y >= $this-> mos_y) break; 
			}
			$index +=1;
			if($index >= count($this->sources)){$index = 0;}
		}
		
		imagejpeg($im, $this->outfile, $this->quality);
		
		imagedestroy($im);
	}
}
 
			


?>