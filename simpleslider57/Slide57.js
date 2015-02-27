function Slide(){
	this.html;
	this.active;
	this.needsOwl;
	this.time = 20;

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

	this.setHueColor = function(color){
		var color = rgbToHex(color[0], color[1], color[2]);
		$.ajax("http://gadgetlab.chnet/color/3/" + color, {
			type: 'GET',
		    crossDomain: true,
		    dataType: 'jsonp',
		});
	}
}

function componentToHex(c) {
    var hex = c.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
}

function rgbToHex(r, g, b) {
    return componentToHex(r) + componentToHex(g) + componentToHex(b);
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
			this.images.shuffle();
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
				this.loadImageAndAppendTo(this.images[i], cropDiv);
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
	this.busy = true;

	var oldShow = this.show;
	this.show = function(){
		oldShow.call(this);
		if(!this.busy){
			var colorThief = new ColorThief();
			var color = colorThief.getColor(this.fullScreenImage);
			this.setHueColor(color)
		}
	}

	var oldMakeHTML = this.makeHTML;
	this.makeHTML = function(){
		oldMakeHTML.call(this);	
		var imageContainer = $("<div>").addClass("image-container");
		this.loadImageAndAppendTo(this.fullScreenImage, imageContainer);
		this.html.html(imageContainer);
		return this;
	}

	this.loadImageAndAppendTo = function(fullScreenImage, appendTo){
		var $this = this;
		var newUrl = "server/imageproxy.php?url=" + encodeURIComponent($(fullScreenImage).prop("src"));
		var width  = $(fullScreenImage).prop("width");
		var height  = $(fullScreenImage).prop("height");
		
		var newImg = $("<img>").attr({src: newUrl, width:width, height:height})
		this.fullScreenImage = newImg[0];
		console.log(this.fullScreenImage);

		$(newImg).load(function() {
			$(this).appendTo(appendTo);
			$this.busy = false;
		})
	}
}

FullScreenImageSlide.prototype = Object.create(Slide.prototype);
FullScreenImageSlide.prototype.constructor = FullScreenImageSlide;
FullScreenImageSlide.prototype.parent = Slide.prototype;

function LoadScreenSlide(){
	this.parent.constructor.call(this);
	this.time = 10000;
	var oldMakeHTML = this.makeHTML;

	this.makeHTML = function(){
		oldMakeHTML.call(this);	
		var imageContainer = $("<div>").addClass("loading centerContent");
		var loadText = $("<h1>").addClass("loading center").text("Loading.....");
		this.html.html(imageContainer.html(loadText));
		
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

function FactSlide(){
	this.parent.constructor.call(this);
	this.fact;
	this.title;
	this.name;

	var oldMakeHTML = this.makeHTML;
	this.makeHTML = function(){
		oldMakeHTML.call(this);	
		var container = $("<div>").addClass("randomBackground");
		var anotherContainer = $("<div>").addClass("centerContent fact")
		var fact = $("<H2>").text(this.fact).addClass("fact");
		var factOwl = $("<div>").addClass("image " + (this.name ? "quote" : "factOwl"));
		var name = $("<h3>").addClass("person");
		if(this.name){
			name.text("- " + this.name);
		}
		this.html.append(container.html(anotherContainer.html(factOwl).append(fact).append(name)));

		return this;
	}

	var oldShow = this.show;
	this.show = function(){
		oldShow.call(this);
		this.html.find("div.randomBackground").css({"background-color": "rgb("+randomInteger(216)+","+randomInteger(216)+","+randomInteger(216)+")"});
	}
}

FactSlide.prototype = Object.create(Slide.prototype);
FactSlide.prototype.constructor = FactSlide;
FactSlide.prototype.parent = Slide.prototype;

function WhosThatPokemonSlide(){
	this.parent.constructor.call(this);
	this.time = 15;

	var oldShow = this.show;
	this.show = function(){
		oldShow.call(this);
		document.getElementById("pokemonFrame").contentWindow.postMessage("reveal#10", "http://jgadelange.github.io");
	}

	var oldRenew = this.renew;
	this.renew = function() {
		oldRenew.call(this);
		var url = "http://jgadelange.github.io/whosthatpokemon/#" + Math.floor(Math.random() * 5502);
		this.html.find("#pokemonFrame").attr({"src": url});
	}

	var oldMakeHTML = this.makeHTML;
	this.makeHTML = function(){
		oldMakeHTML.call(this);
		var iframe = $("<iframe id='pokemonFrame'>").width(1920).height(1080);
		this.html.append(iframe);
		this.renew();
		return this;
	}
}

WhosThatPokemonSlide.prototype = Object.create(Slide.prototype);
WhosThatPokemonSlide.prototype.constructor = WhosThatPokemonSlide;
WhosThatPokemonSlide.prototype.parent = Slide.prototype;

function IframeSlide(){
	this.parent.constructor.call(this);
	this.src;
	this.name;
	this.lastUpdated;
	this.renewTime;

	var oldRenew = this.renew;
	this.renew = function() {
		oldRenew.call(this);
		var currentDate = new Date();
		
		if(this.lastUpdated){
			var difference = Math.abs(currentDate.getTime() - this.lastUpdated.getTime());
			if (difference / ( 3600 * 1000 ) > this.renewTime){
				this.update();
				this.lastUpdated = currentDate;
			}
		} else {
			this.update();
			this.lastUpdated = currentDate;
		}
	}

	this.update = function(){
		this.html.find("#" + this.name).attr({"src": this.src});
	}

	var oldMakeHTML = this.makeHTML;
	this.makeHTML = function(){
		oldMakeHTML.call(this);
		var iframe = $("<iframe id='" + this.name + "'>").width(1920).height(1080);
		this.html.append(iframe);
		this.renew();
		return this;
	}
}

IframeSlide.prototype = Object.create(Slide.prototype);
IframeSlide.prototype.constructor = IframeSlide;
IframeSlide.prototype.parent = Slide.prototype;
