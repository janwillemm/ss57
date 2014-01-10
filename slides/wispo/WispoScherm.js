window.onload = function(){
	LaadWeer();
	
	SetCountdown();
}

function SetCountdown(){
	//Eindtijd
	var wispo = new Date("Jan 31, 2014 20:00:00").getTime();
	
	//Allocatie van tijd variabelen
	var dagen, uren, minuten, seconden
	
	//Zet een countdown functie
	setInterval(function(){
		//Haal seconden over op
		seconden = (wispo - (new Date().getTime())) / 1000;
		
		//Bereken aantal dagen over
		dagen = Math.floor(seconden / 86400);
		
		//Trek aantal dagen ervanaf
		seconden %= 86400;
		
		//Bereken aantal uur over
		uren = Math.floor(seconden / 3600);
		
		//Trek aantal uren ervanaf
		seconden %= 3600;
		
		//Bereken aantal minuten over
		minuten = Math.floor(seconden / 60);
		
		//Trek aantal minuten van seconden over af
		seconden = Math.floor(seconden % 60);
		
		//Zet de countdown
		$("#Countdown").html(
		"<span class=\"Groot Oranje\">" + dagen + "</span> dagen, " +
		"<span class=\"Groot Oranje\">" + uren + "</span> uur, " +
		"<span class=\"Groot Oranje\">" + minuten + "</span> minuten en " + 
		"<span class=\"Groot Oranje\">" + seconden + "</span> seconden!");
	}, 1000);
}

function LaadWeer(){
	//Haal het weer op
	$.getJSON("http://api.openweathermap.org/data/2.5/weather?q=Risoul,fr&lang=nl&units=metric",
	function(weer){
		//Zet de temperatuur
		$("#Temperatuur").html(Math.round(weer.main.temp) + " &#176;C");
		
		//Declare variabele voor image
		var imageSource;
		
		//Switch weather code
		switch(weer.weather[0].icon){
			case "01d" : 
				imageSource = "icons/01d.png"; break;
			case "01n" : 
				imageSource = "icons/01n.png"; break;
			case "02d" : 
				imageSource = "icons/02d.png"; break;
			case "02n" : 
				imageSource = "icons/02n.png"; break;
			case "03d" : 
			case "03n" : 
			case "04d" : 
			case "04n" : 
				imageSource = "icons/03.png"; break;
			case "09d" : 
			case "09n" : 
				imageSource = "icons/09.png"; break;
			case "10d" :
				imageSource = "icons/10d.png"; break;
			case "10n" :
				imageSource = "icons/10n.png"; break;
			case "11d" :
			case "11n" :
				imageSource = "icons/11.png"; break;
			case "13d" :
			case "13n" :
				imageSource = "icons/13.png"; break;
			case "50d" :
				imageSource = "icons/50d.png"; break;
			case "50n" :
				imageSource = "icons/50n.png"; break;
			default :
				imageSource = "icons/01d.png"; break;
		}
	
		//Zet weer plaatje
		$("#WeerPlaatje").html("<img src=\"" + imageSource + "\" alt=\"BVO WIFI\"/>" );
	});
}