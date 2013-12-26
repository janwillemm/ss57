var ss57 = function(){
	var slides = [],
		currentSlide = 0,
		interval,
		switchTime = 10000, // 10 seconds
		isRunning = false;

	function addSlide(slide){
		$(document.body).append(slide.html);
		slides.push(slide);
		if(!isRunning){
			isRunning = true;
			showNextSlide();
			startSlideShow();
		}
	}

	function startSlideShow(){
		if(interval)
			stopSlideShow();

		interval = setInterval(function(){
			showNextSlide();
			isRunning = true;
		}, switchTime);
	}

	function showNextSlide(){
		renewSlideNumber = (currentSlide - 1) % slides.length;
		if(renewSlideNumber < 0)
			renewSlideNumber = slides.length + renewSlideNumber;
		nextSlideNumber = (currentSlide + 1) % slides.length;
		renewSlide(renewSlideNumber)
		hideSlide(currentSlide);
		showSlide(nextSlideNumber);
	}

	function showSlide(number){
		var slide = slides[number];
		currentSlide = number;
		slide.show();
	}

	function hideSlide(number){
		var slide = slides[number];
		slide.hide();
	}

	function renewSlide(number){
		var slide = slides[number];
		slide.renew();
	}

	function stopSlideShow(){
		clearInterval(interval);
		isRunning = false;
	}
	return {
		addSlide: addSlide,
		stop: stopSlideShow
	}
}();

var slideGenerator = function(){
	var urlRegex = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/i,
		flitcieRegex = /https:\/\/flitcie\.ch\.tudelft\.nl\/([0-9]{1,3})\/([a-zA-Z0-9\-]+)/i,
		api = "https://ch.tudelft.nl/api/tv/all.jsonp?callback=?",
		flitcieAPI = "fetchFlitciePhotos.php",
		posterRegex = /https:\/\/ch\.tudelft\.nl\/sites\/default\/files\/[^"]+/,
		rawData;

	function fetchData(){
		$.getJSON(api, function(data){
			$.each(data, parseItem);
		})
	}

	function parseItem(index, item){	
		switch(item.type){
			case "event":
				parseEvent(item);
				break;
			case "tv_item":
				makeSlideForFullScreenImageItem(item);
				break;
			default:
				return;
		}
	}

	function parseEvent(event){
		var hasPictures = flitcieRegex.exec(event.body);
		if(hasPictures) //  Als er foto's opstaan, dan is het event al geweest en willen we de foto's tonen.
			return parsePastEvent(event); // Anders is het een upcoming event en dan moet het getoond worden!
		// TODO misschien is het event al wel geweest, maar staan er nog geen fotos bij?
		if(event['image-fullscreen'].length)
			return makeSlideForFullScreenImageItem(event);
		var poster_url = posterRegex.exec(event.image);
		console.log(poster_url);
		event.posterUrl = poster_url[0];

		var slide = new UpcomingEventSlide(event);
		addSlide(slide.makeHTML());
	}

	function parseEventImage(data){
		return $(data);
	}

	function parsePastEvent(event){
		var flitcieURL = flitcieRegex.exec(event.body);
		var slide = new PastEventSlide(event);
		addSlide(slide.makeHTML());
		$.getJSON(flitcieAPI + "?url=" + flitcieURL[0], function(images){
			makeSlideWithImages(images, slide);
		});
	}

	function makeSlideWithImages(images, slide){
		slide.setImages(images);
		slide.makeHTML()
	}

	function makeSlideForFullScreenImageItem(item){
		var slide = new fullScreenImageSlide(item['image-fullscreen']);
		addSlide(slide.makeHTML());
	}

	function addSlide(slide){
		ss57.addSlide(slide);
	}

	return {
		start: fetchData
	}
}();









