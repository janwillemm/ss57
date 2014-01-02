function Slide(){
	this.html;
	this.active;
	this.needsOwl;

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
		this.html = $("<div>").addClass("slide");
		if(this.needsOwl){
			this.addOwl();
		}
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


function PostEventSlide() {
	this.parent.constructor.call(this);
	
	this.title;
	this.date;
	this.desc;
	this.price;
	this.location;
	this.imageUrl;


	var oldMakeHTML = this.makeHTML;
	this.makeHTML = function(){
		oldMakeHTML.call(this);
		var title = $("<H1>").text(this.title),
			date = $("<p>").addClass("time").html(this.date),
			desc = $("<div>").addClass("desc").html(this.desc),
			price = $("<div>").addClass("price").html(this.price),
			location = $("<div>").addClass("location").html(this.location),
			leftColumn = $("<div>").addClass("left-column").html(title).append(date).append(desc).append(price).append(location),
			rightColumn = $("<div>").addClass("right-column");
			poster = this.loadImageAndAppendTo(this.imageUrl, rightColumn),
		this.html.append(leftColumn).append(rightColumn);
		return this; // Chainability, lazy programming :)
	}
	
}
PostEventSlide.prototype = Object.create(Slide.prototype);
PostEventSlide.prototype.constructor = PostEventSlide;
PostEventSlide.prototype.parent = Slide.prototype;



function PastEventSlide(){
	this.parent.constructor.call(this);

	this.containerDiv;
	this.maxNumberOfImages = 6;

	this.images;
	this.title;

	var oldMakeHTML = this.makeHTML;
	this.makeHTML = function(){
		oldMakeHTML.call(this);
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
					.css({
						"-webkit-transform": "rotate("+deg+"deg", left: left, top: top,
						"-moz-transform": "rotate("+deg+"deg", left: left, top: top
					})
					.html(cropDiv);
				this.loadImageAndAppendTo(this.images.photos[i], cropDiv);
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


function FullScreenImageSlide(){
	this.parent.constructor.call(this);
	
	this.fullScreenImage;

	var oldMakeHTML = this.makeHTML;
	this.makeHTML = function(){
		oldMakeHTML.call(this);	
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

FullScreenImageSlide.prototype = Object.create(Slide.prototype);
FullScreenImageSlide.prototype.constructor = FullScreenImageSlide;
FullScreenImageSlide.prototype.parent = Slide.prototype;

function LoadScreenSlide(){
	this.parent.constructor.call(this);

	var oldMakeHTML = this.makeHTML;
	this.makeHTML = function(){
		oldMakeHTML.call(this);	
		var imageContainer = $("<div>").addClass("image-container center");
		var loadText = $("<h1>").addClass("loading center").text("Loading.....");
		this.loadImageAndAppendTo("images/owl.jpg", imageContainer);
		this.html.html(loadText).append(imageContainer);
		
		return this;
	}
}

LoadScreenSlide.prototype = Object.create(Slide.prototype);
LoadScreenSlide.prototype.constructor = LoadScreenSlide;
LoadScreenSlide.prototype.parent = Slide.prototype;


function StatisticsSlide(){
	this.parent.constructor.call(this);

	this.dataArray;
	this.body;
	this.title;
	this.xAxis;
	this.yAxis;
	this.imageUrl;

	var oldMakeHTML = this.makeHTML;
	this.makeHTML = function(){
		oldMakeHTML.call(this);	
		
		return this;
	}
}

StatisticsSlide.prototype = Object.create(Slide.prototype);
StatisticsSlide.prototype.constructor = StatisticsSlide;
StatisticsSlide.prototype.parent = Slide.prototype;

function CustomHtmlSlide(){
	this.parent.constructor.call(this);

	this.customHtml;

	var oldMakeHTML = this.makeHTML;
	this.makeHTML = function(){
		oldMakeHTML.call(this);	
		this.html.html(this.customHtml);
		return this;
	}

}


