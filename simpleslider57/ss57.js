var ss57 = function(){
	var slides = [],
		currentSlide = 0,
		interval,
		switchTime = 10000, // 10 seconds
		isRunning = false;


	function start(){
		updater.start();
		addSlide(new LoadScreenSlide());
		addSlide(new LoadScreenSlide());
		startSlideShow();
		slideGenerator.fetchSlides(loadedSlides);
	}

	function refreshAll(){
		slideGenerator.fetchSlides(loadedSlides);
	}

	function loadedSlides(newSlides){
		if(isRunning){ // Als er al een slideshow bezig is, dan stoppen we deze.
			removeAllSlides();
		}
		$.each(newSlides, function(index, slide){
			addSlide(slide);
		});
		addSlide(slideGenerator.makeWhosThatPokemonSlide());
		startSlideShow();
	}

	function removeAllSlides(){
		stopSlideShow();
		$(document.body).html($("<div>").addClass("nextSlideSlider"));
		slides.clear();
		this.currentSlide = 0;
	}

	function addSlide(slide){
		$(document.body).append(slide.makeHTML().html);
		slides.push(slide);
	}

	function startSlideShow(){
		if(interval)
			stopSlideShow();
		showNextSlide();
	}

	function showNextSlide(){
		isRunning = true;
		if(slides.length == 1){ // If we have 1 slide, then we should not go round.
			return showSlide(0);
		}
		renewSlideNumber = (currentSlide - 1) % slides.length;
		if(renewSlideNumber < 0)
			renewSlideNumber = slides.length + renewSlideNumber;
		renewSlide(renewSlideNumber);
		hideSlide(currentSlide);

		if(currentSlide == slides.length-1){	
			slides.shuffle();
		}
		nextSlideNumber = (currentSlide + 1) % slides.length;
		showSlide(nextSlideNumber);
	}

	function shuffleSlides(){
		slides.shuffle();
	}

	function showSlide(number){
		var slide = slides[number];
		currentSlide = number;
		slide.show();
		interval = setTimeout(function(){
			showNextSlide();
		}, slide.time*1000);
		slideNextSlideSlider(slide.time*1000);
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

	function slideNextSlideSlider(time){
		var nextSlideSlider = $("div.nextSlideSlider").finish();
		nextSlideSlider.animate({
			width:"1920px"
		}, time, function(){
			$(this).removeAttr('style');
		});
	}

	return {
		start: start,
		refreshAll: refreshAll,
		addSlide: addSlide,
		stop: stopSlideShow
	}
}();

var updater = function(){

	var interval,
		updateTime = 10000;

	function start(){
		interval = setInterval(function(){
			poll();
		}, updateTime);
	}

	function stop(){
		clearInterval(interval);
	}

	function poll(){
		$.get("server/update.php", function(data){
			parseData(data);
		});
	}

	function parseData(data){
		switch(data.type){
			case "refreshAllSlides":
				ss57.refreshAll();
				break;
			case "newSlide":
				ss57.addSlide(slideGenerator.parseItem(data.slide));
				break;

		}
	}


	return {
		start: start
	}
}();

var slideGenerator = function(){
	
	function fetchData(callback){
		api = "server/api.php",
		$.getJSON(api, function(data){
			var slides = $.map(data, parseItem);
			callback(slides);
		})
	}

	function parseItem(item){
		var slide;
		switch(item.type){
			case "PostEventSlide":
				slide = makePostEventSlide(item.slide);
				break;

			case "PastEventSlide":
				slide = makePastEventSlide(item.slide);
				break;

			case "FullScreenImageSlide":
				slide = makeFullScreenImageSlide(item.slide);
				break;

			case "FactSlide":
				slide = makeFactSlide(item.slide);
				break;

			case "IframeSlide":
				slide = makeIframeSlide(item.slide);
				break;

			default: 
				alert("Error, slide not implemented yet!");
		}
		slide.needsOwl = item.slide.needsOwl;
		slide.time = item.slide.time;
		return slide;
	}

	function makePostEventSlide(event){
		var slide = new PostEventSlide();
		slide.title = event.title;
		slide.date = event.readableDate;
		slide.desc = event.desc;
		slide.location = event.location;
		slide.price = event.price;
		slide.imageUrl = event.imageUrl;
		return slide;
	}

	function makePastEventSlide(event){
		var slide = new PastEventSlide();
		slide.title = event.title;
		slide.images = event.images;
		return slide;
	}

	function makeFullScreenImageSlide(item){
		var slide = new FullScreenImageSlide();
		slide.fullScreenImage = item.imageBlock;
		return slide;
		
	}

	function makeFactSlide(item){
		var slide = new FactSlide();
		slide.title = item.title;
		slide.fact = item.fact;
		return slide;
	}

	function makeIframeSlide(item){
		var slide = new IframeSlide();
		slide.title = item.title;
		slide.src = item.src;
		slide.renewTime = item.renewTime;
		return slide;
	}

	function makeWhosThatPokemonSlide(){
		var slide = new WhosThatPokemonSlide();
		return slide;
	}

	return {
		fetchSlides: fetchData,
		parseItem : parseItem,
		makeWhosThatPokemonSlide : makeWhosThatPokemonSlide
	}
}();






