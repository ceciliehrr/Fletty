<?php include "head.php"; ?>

<body>
<?php include "navbar.php";?>
<div class="container-fluid">


<?php

include "../../koble_til_database.php" ;

$status = $_POST['status'];
$skjermet = $_POST['skjermet'];
$forventet= $_POST['forventet'];
$arkivskaper= $_POST['arkivskaper'];
$arkivleder= $_POST['arkivleder'];
$startdato = $_POST['startDato'];
$sluttdato= $_POST['sluttDato'];
$saksNR= $_POST['saksNR'];
$mottattDato= $_POST['mottattdato'];
$system= $_POST['system'];
$systemversjon=$_POST['systemversjon'];
$systemtype= $_POST['systemtype'];
$databaseplattform= $_POST['databaseplattform'];
$etikett= $_POST['etikett'];
session_start();
$ansvarlig= $_SESSION['login_user'];
$kommentar= $_POST['kommentar'];
$endretAv= $_SESSION['login_user'];


//legger inn verdiene i databasen

$sql = "
		INSERT INTO uttrekk
		(skjermet, arkivskaper,arkivleder,  status, startDato, sluttDato, saksNR, mottattDATO, forventetAnkomst, system, systemversjon, systemtype,databaseplattform,
		  etikett, ansvarlig, kommentar, sistendret, endretAv)
		 VALUES
		 ('$skjermet','$arkivskaper','$arkivleder', '$status', '$startdato', '$sluttdato', '$saksNR', '$mottattDato', '$forventet', '$system', '$systemversjon', '$systemtype',
		   '$databaseplattform','$etikett', '$ansvarlig', '$kommentar', now(), '$endretAv')

	   ";
$resultat = $db->query($sql);

if (!empty($resultat)) {
	echo "<div class='alert alert-success'alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><h1>Uttrekk lagret</h1>";
	echo "<p> Spørringen<p/>";
	echo "<blocknote>$sql</blocknote>";
	echo "<p>ble utført</p>";
	echo "</div><br>";
	
}
else {
	echo "<div class='alert alert-danger'alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><p>Noe gikk galt</p>";
	echo ("Error description: " . mysqli_error($db));
	echo "<p><a href='javascript:history.go(-1)'>Gå tilbake</a></p></div>";
}

// Henter siste ID
if ($resultat === TRUE){
	$last_id = $db->insert_id;
} else {
    echo "<div class='alert alert-danger'alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Error: " . $sql . "<br>" . $db->error . "</div><br>";
}

//Om det har blitt lastet ned en fil, updates uttrekk med last_id

session_start();
if(!empty($_SESSION['filnavn'])) {

$filnavn= $_SESSION['filnavn'];

$sql = "UPDATE uttrekk
SET infofil='$filnavn'
WHERE id='$last_id'
		";
if ($db->query($sql)) {
	echo "<div class='alert alert-success'alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>OK fil koblet til uttrekk</div>";
	
	
}
else {
	echo "<div class='alert alert-danger'alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><p> Noe gikk galt</p></div>";
	echo("Error description: " . mysqli_error($db));
}	

} // if session not empty

$db->close();
 

 
include "../footer2.html" ;
?>




</div>
</body>
</html>
