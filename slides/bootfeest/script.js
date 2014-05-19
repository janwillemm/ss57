var Settings = {
	fps: 60,

	waveCount: 3,
	waveDistance : 80,
	waveMoveDistance: 100,
	secondsPerWaveMotion : 4,

	boatSecondsToEnd: 10,
	delayBetweenInverting: 5,
	distancePerBounce: 200,
	bounceHeight:30
}

var boatMovingRight = true;
var timeoutRunning = false;
var SeaWavePhase = [];

window.onload = function(){
	BuildSea();
	StartBoat();

	setInterval(Update, 1000 / Settings.fps);
}

function StartBoat(){
	$("#boat").css({top:0, left:-249});
	$("#boat_inverted").css({top:0, left: 1920});
}

function InvertBoat(){
	timeoutRunning = false;

	StartBoat();
	boatMovingRight = !boatMovingRight;
}

function UpdateBoat(){
	var $boat = (boatMovingRight ? $("#boat") : $("#boat_inverted"));
	var currentLeft = parseInt($boat.css("left"));

	/*Check if boat should turn around*/
	if(!timeoutRunning 
		&& ((boatMovingRight && currentLeft > 1920)
		|| (!boatMovingRight && currentLeft < -249))){
		setTimeout(InvertBoat, 1000 * Settings.delayBetweenInverting);
		timeoutRunning = true;
	}

	var newLeft = currentLeft + (boatMovingRight ? 1 : -1) * (2169 / (Settings.fps * Settings.boatSecondsToEnd));

	$boat.css({
		top: -Math.abs(Math.sin(Math.PI * (newLeft / Settings.distancePerBounce))) * Settings.bounceHeight,
		left: newLeft
	});
}

function BuildSea(){
	for(var i = 0; i < Settings.waveCount; i++){
		var $seadiv = $("<div class=sea id=sea" + i +  "/>");
		$seadiv.css({top: Settings.waveDistance * i, left: 0});
		SeaWavePhase.push(Math.random() * Math.PI);

		$("#sea_holder").append($seadiv)
	}
}

function UpdateSea(){
	for(var i = 0; i < Settings.waveCount; i++){
		/*Updating the phase variable*/
		SeaWavePhase[i] += (2 * Math.PI) / (Settings.secondsPerWaveMotion * Settings.fps);
		
		/*Updating the actual div*/
		var $seadiv = $("#sea" + i);
		$seadiv.css({
			top: Settings.waveDistance * i,
			left: Settings.waveMoveDistance * Math.cos(SeaWavePhase[i]) - Settings.waveMoveDistance
		});
	}
}

function Update(){
	UpdateBoat();
	UpdateSea();
}