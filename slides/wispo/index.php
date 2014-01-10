<!DOCTYPE html>
<html>
	<body>
		<link rel="stylesheet" type="text/css" href="WispoScherm.css" media="screen" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="WispoScherm.js" ></script>
		
		<div id="Titel">WINTERSPORT!!</div>
		
		<div id="GebiedStatistieken" >
			<div id="Weersverwachting" class="WispoText">
				Weer in Risoul:<br/>
				<div id="WeerPlaatje"></div><br/>
				<div id="Temperatuur"></div>
			</div>
			
			<div id="Sneeuwhoogte" class="WispoText">
				Sneeuwhoogte in Risoul:<br/>
				<div id="SneeuwStatistieken">
					<?php
						//Haal sneeuwval op
						$JSON = file_get_contents("http://www.myweather2.com/developer/weather.ashx?uac=pYEIisnJdU&uref=09dc4dab-022e-48d3-b335-218bcac19554&output=json");
						
						//Decode de json string
						$sneeuw = json_decode($JSON);
						
						//Haal dal en berg sneeuwhoogte op
						$dal = $sneeuw->weather->snow_report[0]->lower_snow_depth;
						$berg = $sneeuw->weather->snow_report[0]->upper_snow_depth;
					?>
					<div class="Oranje">Berg: <span class="Blauw" id="Berg"><?php echo $berg;?> centimeter</span><br/></div>
					<div class="Oranje">Dal: <span class="Blauw" id="Dal"><?php echo $dal;?> centimeter</span><br/></div>
				</div>
			</div>
		</div>
		
		<div id="CountdownText" class="WispoText">Nog <span id="Countdown"></span></div>
	</body>
</html>