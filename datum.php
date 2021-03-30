<?php
	
	function print_pre($array) {
		
		echo "<pre>";
		print_r($array);
		echo "</pre>";
		
	}
	
	/*
	getdate() gibt folgendes Array zurück
	[seconds] => 47			Sekunde
	[minutes] => 18			Minute
	[hours] => 10			Stunde
	[mday] => 7				Tag des Monats
	[wday] => 4				Tag der Woche 
							(0 -> Sonntag)
							(1 -> Montag)
							(2 -> Dienstag)
							(3 -> Mittwoch)
							(4 -> Donnerstag)
							(5 -> Freitag)
							(6 -> Samstag)
	[mon] => 12				Monat
	[year] => 2017			Jahr
	[yday] => 340			Tag des Jahres
	[weekday] => Thursday	Wochentag (ausgeschrieben)
	[month] => December		Monat (ausgeschrieben)
	[0] => 1512638327		Sekunden in UNIX-Zeit
							Anzahl der Sekunden seit dem 01.01.1970
							
	time() gibt direkt die UNIX-Zeit aus (getdate()[0])
	
	
	date($format, $unixtime) formatiert eine UNIX-Zeit wie angegeben
		
		r		Zeitstempel nach RFC 822/2822
				Thu, 7 Dec 2017 10:43:30 +0100 
		
		Y (gr.)	Jahr, vierstellig
		y		Jahr, zweistellig
	
		m		Monat (mit führende 0)	[01-12]
		n		Monat (ohne führende 0) [1-12]
		
		d 		Tag des Monats, zweistellig (mit führende 0) [01-31]
		j 		Tag des Monats, zweistellig (ohne führende 0) [1-31]
		
		G 		Stunde (24h format) (ohne führende 0)	[0-23]
		H		Stunde (24h format) (mit führende 0)	[00-23]
				
		i 		Minute (mit führende 0) [00-59]
		s 		Sekunden (mit führende 0) [00-59]
	
	
	*/
	
	$ts = getdate();
	
	// Aktuelles Datum ausgeben (umständlich)
	echo $ts["mday"].".".$ts["mon"].".".$ts["year"]."<br>";
echo "<hr>";
	echo time()."<br>";
	
	echo date("d.m.Y", $ts[0])."<br>";
	echo "<hr><hr>";
	echo date("d.m.Y", time())."<br>";
	echo date("m-d-Y", time())."<br>";
	echo date("H:i:s", time())."<br>";
	
	// Alternativ, aber nicht empfohlen
	echo "<br>VOR setlocale<br>";
	echo strftime("%x", time())."<br>";
	echo strftime("%X", time())."<br>";
	
	echo "<br>NACH setlocale<br>";
	setlocale(LC_ALL, "syr");
	echo strftime("%x", time())."<br>";
	echo strftime("%X", time())."<br>";
	
	
	// microtime()
	// 0.94794500 1512642556 (ohne Parameter) aktuelle Zeit in Mikrosekunden gefolgt von Sekunden
	// 1512642556.94794500	 (mit Parameter TRUE) aktuelle Zeit in Sekunden,Mikrosekunden
	echo "<br>".microtime(true)."<br>";
	
	// Zeitmessung von Funktionsabläufen
	
	// Startzeit merken
	$time1 = microtime(true);
	
	for ($i = 0; $i <= 10000000; $i++) {
		
		$var = 0;
		
	}
	
	// Endzeit merken
	$time2 = microtime(true);
	
	// Zeitdifferenz ausrechnen (100* um von Mikrosekunden auf Millisekunden zu kommen)
	$result = 100 * ($time2 - $time1);
	
	echo "<br>".$result." Millisekunden</br>";

	
	
?>