<?php

/**
 * @copyright 2009
 */


/*    EXAMPLE */

ini_set('memory_limit', '-1');

include_once("Mosaic.php");

//$outfile 		=	"/mosaic.jpg"; 	
//$outfile		= 	"test.jpg"; 			
$quality  		=	100; 			
$dir			=	"/Users/jw/picturesss";


$res = new buildMosaic($dir,$outfile,$quality);
header('Content-type: image/jpeg');
$res->makeMos();

?>