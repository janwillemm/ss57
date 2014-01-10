window.onload = function(){	
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