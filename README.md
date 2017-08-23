# Fletty

HUSK lag en fil for databasetilkobling:

<?php
	$IPAdresse = "localhost"; 
	$databasenavn = "";
	$brukernavn = "";
	$passord = "";
	
	$db = new mysqli($IPAdresse, $brukernavn, $passord, $databasenavn);
	$db->set_charset('utf8mb4');
   /*
	print "Prøver å opprette kobling til " . PHP_EOL;
	print "maskin (" . $IPAdresse . "), " . PHP_EOL;
	print "database (" . $databasenavn . "), " . PHP_EOL;
	print "brukernavn (" . $brukernavn . "), " . PHP_EOL;
	print "passord (" . $passord . ")" . PHP_EOL;
*/
	if ($db->connect_errno > 0){
		print "Kunne ikke koble til database (" . $db->connect_error . ")" . PHP_EOL;
	}
	/*
	else {
		print "Koblet til database" . PHP_EOL;
	}
	

	
if	(!mysqli_query($db,$sql))
  {
  echo("Error description: " . mysqli_error($db));
  }
	
	*/
?>
