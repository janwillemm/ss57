<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<!--
		Supersized - Fullscreen Slideshow jQuery Plugin
		Version : 3.2.7
		Site	: www.buildinternet.com/project/supersized
		
		Author	: Sam Dunn
		Company : One Mighty Roar (www.onemightyroar.com)
		License : MIT License / GPL License
	-->

	<head>

		<title>CH TV nr <?php echo $_GET['tv']; ?></title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		
		<link rel="stylesheet" href="css/supersized.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="theme/supersized.shutter.css" type="text/css" media="screen" />
		
		<script>
		// elk uur of 's nachts herladen pagina
		var everyHour = true;
		var reloadInterval = setInterval(function(){
			if(everyHour || (new Date).getHours() == 23){
				location.reload();
			}
		}, 1000*3600);
		</script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/js.animate.patch.js"></script>
		<script type="text/javascript" src="js/jquery.easing.min.js"></script>
		
		
		<script type="text/javascript" src="js/supersized.3.2.7.js"></script>
		<script type="text/javascript" src="theme/supersized.shutter.min.js"></script>
		<script type="text/javascript" src="js/froogaloop.min.js"></script>
		
		<script type="text/javascript">
			
			function construct($, slides){
				
				$.supersized({
				
					// Functionality
					slideshow               : 1,			// Slideshow on/off
					autoplay								:	1,			// Slideshow starts playing automatically
					start_slide             : 1,			// Start slide (0 is random)
					stop_loop								:	0,			// Pauses slideshow on last slide
					random									: 0,			// Randomize slide order (Ignores start slide)
					slide_interval          : 12000,		// Length between transitions
					transition              : 3, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed				:	1000,		// Speed of transition
					new_window							:	1,			// Image links open in new window/tab
					pause_hover             : 0,			// Pause slideshow on hover
					keyboard_nav            : 1,			// Keyboard navigation on/off
					performance							:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
					image_protect						:	0,			// Disables image dragging and right click with Javascript
															   
					// Size & Position						   
					min_width		        		: 0,			// Min width allowed (in pixels)
					min_height		       		: 0,			// Min height allowed (in pixels)
					vertical_center         : 1,			// Vertically center background
					horizontal_center       : 1,			// Horizontally center background
					fit_always							:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
					fit_portrait       	  	: 1,			// Portrait images will not exceed browser height
					fit_landscape						: 0,			// Landscape images will not exceed browser width
															   
					// Components							
					slide_links							:	'blank',// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					thumb_links							:	0,			// Individual thumb links for each slide
					thumbnail_navigation    : 0,			// Thumbnail navigation
					slides 									: slides,
												
					// Theme Options			   
					progress_bar			:	1,			// Timer for each slide							
					mouse_scrub				:	0
					
				});
		    
			}
			
			var urlRegex = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/i;
			var flitcieRegex = /https:\/\/flitcie\.ch\.tudelft\.nl\/([0-9]{1,3})\/([a-zA-Z0-9\-]+)/i;
			var api = "https://ch.tudelft.nl/api/tv/all.jsonp?callback=?";
			$.getJSON(api, function(data){
				construct($, data.map(function(slideData){
					var flitcieRegex = /https:\/\/flitcie\.ch\.tudelft\.nl\/([0-9]{1,3})\/([a-zA-Z0-9\-]+)/i;
					var isFlitcie = flitcieRegex.exec(slideData.body);
					
					var valid = (
						slideData.type == 'event' && isFlitcie ||
						slideData.body.length > 0 && slideData.type == 'tv_item' || 
						slideData['image-fullscreen'] && slideData['image-fullscreen'].length > 0
					);
					
					// Animate album while visible
					if(isFlitcie){
					  slideData.action = function(data){
	 						var $obj = this;
	
	 						function animate(){
	 							var ifrm = $obj.find("iframe").get(0);
	 							if(ifrm){
	 								var jQ = ifrm.contentWindow.jQuery;
	 								jQ(ifrm.contentWindow.document.body).trigger("keyup", {keyCode: 32});
	 							} else console.log("Flitcie couldn't animate :(");
	 						}
	 						setTimeout(animate, 5000);
	 						setTimeout(animate, 9000);
	 					};
						if(window.location.href.indexOf("buiten") > 0) return; 
					}
					
					if(valid) return slideData;
				}).filter(function(item){ return item; }));
			});
				
		</script>
		
	</head>
	
	<style type="text/css">
		ul#demo-block{ margin:0 15px 15px 15px; }
			ul#demo-block li{ margin:0 0 10px 0; padding:10px; display:inline; float:left; clear:both; color:#aaa; background:url('img/bg-black.png'); font:11px Helvetica, Arial, sans-serif; }
			ul#demo-block li a{ color:#eee; font-weight:bold; }
	</style>

<body>
	<!--End of styles-->

	<!--Thumbnail Navigation-->
	<div id="prevthumb"></div>
	<div id="nextthumb"></div>
	
	<div id="thumb-tray" class="load-item">
		<div id="thumb-back"></div>
		<div id="thumb-forward"></div>
	</div>
	
	<!--Time Bar-->
	<div id="progress-back" class="load-item">
		<div id="progress-bar"></div>
	</div>
	
	<!--Control Bar-->
	<div id="controls-wrapper" class="load-item">
		<div id="controls">
			
			<a id="play-button"><img id="pauseplay" src="img/pause.png"/></a>
		
			<!--Slide counter-->
			<div id="slidecounter">
				<span class="slidenumber"></span> / <span class="totalslides"></span>
			</div>
			
			<!--Slide captions displayed here-->
			<div id="slidecaption"></div>
			
			<!--Thumb Tray button-->
			<a id="tray-button"><img id="tray-arrow" src="img/button-tray-up.png"/></a>
			
			<!--Navigation-->
			<ul id="slide-list"></ul>
			
		</div>
	</div>
	<style>
	#controls-wrapper {
		display: none;
		visibility: collapse;
	}
	#progress-back {
		bottom: 0;
	}
	
	#supersized > li { display: none; }
	#supersized > li.activeslide,	#supersized > li.prevslide, #supersized > li.nextslide { display: block; }
	</style>

</body>
</html>
