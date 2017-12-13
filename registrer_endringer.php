<!DOCTYPE html>
<html lang="no">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Mobilvennlig -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<title>Digitalt Depot</title>
</head>

<body>
<?php include "navbar.php"; ?>



<div class="container-fluid">

<br>

<?php
// koden for validering av info i felter skal inn her

include "../../koble_til_database.php" ;


// hvis lagreknappen er trykket oppdater endringer
	if (isset($_POST['lagre']) ) {
/*		
$beskjed= "<h1> Feil</h1><div>";
$feil= false;

if (empty( $_POST['arkivskaper']) ) {
	$beskjed .= "arkivskaper er ikke utfylt<br />";
	$feil = true;
}
if (empty( $_POST['system']) ) {
	$beskjed .= "System er ikke utfylt<br />";
	$feil = true;
}
if (empty( $_POST['ansvarlig']) ) {
	$beskjed .= "Ansvarlig er ikke utfylt<br />";
	$feil = true;
}
if ($feil)
	die($beskjed . "<p><a href='javascript:history.go(-1)'>Gå tilbake</a></p></div>");

*/
//Endrer dato til riktig datoformat: $forventetAnkomst = date('Y-m-d',strtotime($_POST['forventet']));


$sql = "UPDATE uttrekk SET
			status ='" . $_POST['status'] . "',
			skjermet ='" . $_POST['skjermet'] . "',
			forventetAnkomst = '" . $_POST['forventet'] . "',
			arkivskaper='" . $_POST['arkivskaper'] . "',
			arkivleder='" . $_POST['arkivleder'] . "',
			startDato='" . $_POST['startDato'] . "',
			sluttDato='" . $_POST['sluttDato'] . "',
			saksNR='" . $_POST['saksNR'] . "',
			mottattDATO ='" . $_POST['mottattdato'] . "',
			system='" . $_POST['system'] . "',
			systemversjon='" . $_POST['systemversjon'] . "',
			systemtype='" . $_POST['systemtype'] . "',
			databaseplattform='" . $_POST['databaseplattform'] . "',
			etikett='" . $_POST['etikett'] . "',
			ansvarlig='" . $_SESSION['login_user'] . "',
			kommentar='" . $_POST['kommentar'] . "',
			endretAv='" . $_SESSION['login_user'] . "',
			sistendret=now()
			
			";
			
$sql.= " WHERE id ='" . $_POST['id'] . "'";

echo "<div class='alert alert-success'alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>$sql
</div>";



$registrer = $db->query($sql);



?>
<div class="alert alert-success alert-dismissible" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
<!-- Tilbakemelding når raden er endret -->
<h4 class="alert-heading"> Uttrekket ble endret! </h4>
<br>
</div>


<?php	} //if
	
		$db->close();
?>

<?php include "../footer2.html" ; ?>

</div>
</body>
</html>