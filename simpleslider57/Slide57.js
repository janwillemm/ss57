function Slide(){
	this.html = $("<div>").addClass("slide");
	this.active;

	this.show = function(){
		this.html.addClass("show");
		this.active = true;
	}

	this.hide = function(){
		this.html.removeClass("show");
		this.active = false;
	}

	this.renew = function() {
		
	}

	this.makeHTML = function(){
		console.log("Yet to be implemented")
	}

	this.addOwl = function(){
		var h1 = $("<h1>").text(this.title);
		var CHBalk = $("<div>").addClass("CHBalk").append(h1);
		var CHLogo = $("<div>").addClass("CHLogo");
		this.html.html(CHBalk).append(CHLogo);
	}

	this.loadImageAndAppendTo = function(imageUrl, appendTo){
		$('<img src="'+ imageUrl +'">').load(function() {
			$(this).appendTo(appendTo);
		})
	}
}


function UpcomingEventSlide(event) {
	this.parent.constructor.call(this);
	this.event = event;

	this.makeHTML = function(){
		
		var title = $("<H1>").text(event.title),
			date = $("<p>").addClass("time").html(event.date_poster),
			desc = $("<div>").addClass("desc").html(event.body),
			leftColumn = $("<div>").addClass("left-column").html(title).append(date).append(desc),
			rightColumn = $("<div>").addClass("right-column");
			poster = this.loadImageAndAppendTo(event.posterUrl, rightColumn),
		this.html.append(leftColumn).append(rightColumn);
		return this; // Chainability, lazy programming :)
	}
	
}
UpcomingEventSlide.prototype = Object.create(Slide.prototype);
UpcomingEventSlide.prototype.constructor = UpcomingEventSlide;
UpcomingEventSlide.prototype.parent = Slide.prototype;



function PastEventSlide(event){
	this.parent.constructor.call(this);
	this.images;
	this.title = event.title;
	this.containerDiv;
	this.maxNumberOfImages = 6;

	this.setImages = function(images){
		this.images = images;
	}

	this.makeHTML = function(){
		this.addOwl();
		this.containerDiv = $("<div>").addClass("container");
		this.renewImages();
		this.html.append(this.containerDiv);
		return this;
	}
	
	var oldRenew = this.renew;
	this.renew = function(){
		oldRenew.call(this);
		this.renewImages();
	}

	this.renewImages = function(){
		if(this.images){
			this.containerDiv.empty();
			this.images.photos.shuffle()
			var maxIndex = Math.min(this.images.length, this.maxNumberOfImages);
			for(var i = 0; i < maxIndex; i++){
				var deg = randomFromInterval(-5,5);
				var left = randomFromInterval(-5,5);
				var top = randomFromInterval(-5,5);
				var cropDiv = $("<div>").addClass("photoCrop");
				var photoDiv = $("<div>").addClass("photo")
					.css({"-webkit-transform": "rotate("+deg+"deg", left: left, top: top})
					.html(cropDiv);
				this.loadImageAndAppendTo("https://flitcie.ch.tudelft.nl/var/resizes/"+this.images.photos[i], cropDiv);
				this.containerDiv.append(photoDiv);
			}
		}
		else {

		}
	}
}
PastEventSlide.prototype = Object.create(Slide.prototype);
PastEventSlide.prototype.constructor = PastEventSlide;
PastEventSlide.prototype.parent = Slide.prototype;


function fullScreenImageSlide(fullScreenImage){
	this.parent.constructor.call(this);
	this.fullScreenImage = fullScreenImage;

	this.makeHTML = function(){
		
		var imageContainer = $("<div>").addClass("image-container");
		this.loadImageAndAppendTo(this.fullScreenImage, imageContainer);
		this.html.html(imageContainer);
		return this;
	}

	this.loadImageAndAppendTo = function(fullScreenImage, appendTo){
		$(fullScreenImage).load(function() {
			$(this).appendTo(appendTo);
		})
	}
}

fullScreenImageSlide.prototype = Object.create(Slide.prototype);
fullScreenImageSlide.prototype.constructor = fullScreenImageSlide;
fullScreenImageSlide.prototype.parent = Slide.prototype;






