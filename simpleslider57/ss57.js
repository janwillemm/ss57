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
	
	function fetchData(){
		api = "server/api.php",
		$.getJSON(api, function(data){
			$.each(data, parseItem);
		})
	}

	function parseItem(index, item){
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

			default: 
				alert("Error, slide not implemented yet!");
		}
		slide.needsOwl = item.slide.needsOwl;
		slide.makeHTML();
		addSlide(slide);
		console.log(slide);
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

	function addSlide(slide){
		ss57.addSlide(slide);
	}

	return {
		start: fetchData
	}
}();








