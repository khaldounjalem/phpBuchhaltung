<?php 
 $con = mysqli_connect("localhost", "root", "", "invoice");
// $con = mysqli_connect("localhost", "", "", "");	
	// Prüfen, ob beim Verbindungsaufbau ein Fehler aufgetreten ist
	if (mysqli_connect_errno()) {
		// Bei einem Fehler -> TRUE
		// Kein Fehler -> FALSE
		die ("MySQL-Fehler: ".mysqli_connect_error());
	}
mysqli_set_charset($con,"utf8");

?>
