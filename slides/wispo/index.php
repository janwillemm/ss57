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
					<?php
						//Haal sneeuwval op
						$JSON = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=Risoul,fr&lang=nl&units=metric");
						
						//Decode de json string
						$weer = json_decode($JSON);
						
						//Switch weather code
						switch($weer->weather[0]->icon){
							case "01d" : 
								$imageSource = "icons/01d.png"; break;
							case "01n" : 
								$imageSource = "icons/01n.png"; break;
							case "02d" : 
								$imageSource = "icons/02d.png"; break;
							case "02n" : 
								$imageSource = "icons/02n.png"; break;
							case "03d" : 
							case "03n" : 
							case "04d" : 
							case "04n" : 
								$imageSource = "icons/03.png"; break;
							case "09d" : 
							case "09n" : 
								$imageSource = "icons/09.png"; break;
							case "10d" :
								$imageSource = "icons/10d.png"; break;
							case "10n" :
								$imageSource = "icons/10n.png"; break;
							case "11d" :
							case "11n" :
								$imageSource = "icons/11.png"; break;
							case "13d" :
							case "13n" :
								$imageSource = "icons/13.png"; break;
							case "50d" :
								$imageSource = "icons/50d.png"; break;
							case "50n" :
								$imageSource = "icons/50n.png"; break;
							default :
								$imageSource = "icons/01d.png"; break;
						}
						
						//Zet temperatuur
						$temperatuur = $weer->main->temp;
					?>
				<div id="WeerPlaatje"><img src="<?php echo $imageSource; ?>" alt="WIFI VOOO"/></div><br/>
				<div id="Temperatuur"><?php echo floor($temperatuur); ?> &#176;C</div>
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