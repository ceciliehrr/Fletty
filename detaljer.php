<!DOCTYPE html>
<html lang="no">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
 
<style>
.uttrekkInfo {
	width: 100%;
	height: 200px;
}


</style>

  
  <title>Digitalt Depot</title>
</head>
<body>
<?php include "navbar.php"; ?>

 <!-- Start på form -->
<?php

include "../../koble_til_database.php" ;
	
	//henter ut all info om id
	$sql = "SELECT * FROM uttrekk WHERE id = '" . $_POST['id'] . "' ";
	$resultat = $db->query($sql);
	$antall = $resultat->num_rows;



	for ($i = 0; $i<$antall; $i++) {
		$rad = $resultat->fetch_assoc();
		$id = $rad['id'];
		
?>
	<div class="container-fluid">
<div class="jumbotron">
  <h1><?php echo $rad['arkivskaper']; echo " - " . $rad['system'];?>
<?php
  include "prosessbar.php";?></h1> 
<?php 
  if (!empty($rad['slettet'])) {
	   echo "<h2 style='float:right;'>Slettet :" . $rad['slettet'] . "</br></h2>";
	   echo "<h2 style='float:right;'>Slettet av:" . $rad['slettetAv'] . "</h2>";
  }
?>

	<div class="uttrekkInfo">

	<div class="col-sm-12 well">
	<div class="row">
				<form>
					<div class="col-lg-12">
						<div class="row">
							<div class="col-sm-3 form-group">
								<label>Arkivskaper</label>
								<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $rad['arkivskaper']; ?>" disabled>
							</div>
							<div class="col-sm-3 form-group">
								<label>Saksnummer</label>
								<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $rad['saksNR']; ?>" disabled>
								</div>
								<div class="col-sm-3 form-group">
								<label>Arkivleder</label>
								<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $rad['arkivleder']; ?>" disabled>
								</div>
								<div class="col-sm-3 form-group">
								<label>Etikett på avleveringsmediet</label>
								<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $rad['etikett']; ?>" disabled>
								</div>
								</div>	
							<div class="row">
						  <div class="col-sm-3 form-group">
								<label>Start dato - slutt dato</label>
								<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $rad['startDato']. " - " . $rad['sluttDato']; ?>" disabled>
							</div>
									  <div class="col-sm-3 form-group">
								<label>Forventet ankomst</label>
								<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $rad['forventetAnkomst']; ?>" disabled>
							</div>
								  <div class="col-sm-3 form-group">
								<label>Mottatt dato</label>
								<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $rad['mottattDATO']; ?>" disabled>
							</div>
									  <div class="col-sm-3 form-group">
								<label>Inneholder skjermet informasjon?</label>
								<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $rad['skjermet']; ?>" disabled>
							</div>
							</div>
							
						<div class="row">
						  <div class="col-sm-3 form-group">
								<label>System</label>
								<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $rad['system']; ?>" disabled>
							</div>
									  <div class="col-sm-3 form-group">
								<label>Systemversjon</label>
								<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $rad['systemversjon']; ?>" disabled>
							</div>
								  <div class="col-sm-3 form-group">
								<label>Systemtype</label>
								<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $rad['systemtype']; ?>" disabled>
							</div>
									  <div class="col-sm-3 form-group">
								<label>Databaseplattform</label>
								<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $rad['databaseplattform']; ?>" disabled>
							</div>
							</div>
							
									
						<div class="form-group">
							<label>Kommentar</label>
							<textarea rows="10" class="form-control" id="disabledInput" name="text" placeholder="<?php echo $rad['kommentar']; ?>" disabled></textarea>
						</div>
					</div>
<?php		} //forlokke  

		 	$db->close();?>
			
<br>
<br>
								<!--Start på hente riktig infofil -->
<?php

include "../../koble_til_database.php" ;
$query = "    SELECT infofil
			FROM uttrekk
			INNER JOIN infofiler
			ON uttrekk.infofil = infofiler.filnavn
			WHERE id = '$id'";
			
$result = $db->query($query);
if(mysqli_num_rows($result) == 0)
{
echo "<span class='glyphicon glyphicon-remove-circle'></span>  Ingen infofil</br>";
} 
else
{
while(list($filnavn) = mysqli_fetch_array($result))
{
?>
<div class="fil" style="margin-left: 30px;">
<span class="glyphicon glyphicon-floppy-save" style="font-size: 2.0em; margin-right: 2px;"></span>
<a href="<?php echo $filnavn;?>" target= "_blank"> Hent infofil</a>
</div>

<?php 
}
}
$db->close();
?>
			


				</form> 
				</div>
				
				
				
	</div>
	</div> <!--Slutt på form-->
	 

			
			

   <!--SELECT kommentar FROM `flettylogg` WHERE id='3'  -->
  <h1>Endringslogg</h1>
 <br>
 <div class="form-group">
 <label>Tidligere kommentarer</label>
<textarea class="form-control" id="disabledInput" name="text" rows="5" disabled>
<?php
include "../../koble_til_database.php" ;

 $sql = "SELECT kommentar FROM flettylogg WHERE id='" . $_POST['id'] . "' ";
  $resultat = $db->query($sql);
  $antall = $resultat->num_rows;


	for ($i = 0; $i<$antall; $i++) {
		$rad = $resultat->fetch_assoc();
		$id = $rad['id'];
		echo $rad['kommentar'] . PHP_EOL;
		
		}
	$db->close();
?>
	</textarea>
</div>	<!-- Slutt på gamle kommentarer-->
		
 

 
 <!--Tabellen med tidligere endringer og sletting.Logg-->

 <div class="tabell">
<table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
		<th>Arkivskaper</th>
		<th>Start dato</th>
		<th>Slutt dato</th>
		<th>Status</th>	
        <th>Saksnummer</th>
        <th>Mottattdato</th>
        <th>System</th>
		<th>Etikett</th>
        <th>Ansvarlig</th>
		<th>Sist endret</th>
		<th>Endret Av</th>
      </tr>
    </thead>
	<tbody>
<?php

include "../../koble_til_database.php" ;


 $sql = "SELECT id, arkivskaper, startDato, sluttDato,  status, saksNR, mottattDATO, system,
		  etikett, ansvarlig, sistendret, endretAv FROM flettylogg WHERE id='" . $_POST['id'] . "' ORDER BY sistendret DESC";
  $resultat = $db->query($sql);
  $antall = $resultat->num_rows;


	for ($i = 0; $i<$antall; $i++) {
		$rad = $resultat->fetch_assoc();
		$id = $rad['id'];

		

echo "<tr>";



foreach ($rad as $nokkel => $verdi) {
	$feltnavn = str_replace("_", " ", $nokkel);
	$feltnavn = ucfirst($feltnavn);
	
	//legger farge på ulike typer deponeringer
	
	$status = $rad['status'];
	
	if ($status == "1: Avtalt") {
	echo "<th class='active'>$verdi</th>";
    }
	
	if ($status == "2: Mottatt") {
	echo "<th bgcolor='#ffffcc'>$verdi</th>";
    }
	
	if ($status == "3: I karantene") {
	echo "<th class='warning'>$verdi</th>";
    }
	
	if ($status == "4: Avvist, venter ny deponering") {
	echo "<th bgcolor='#e6b3cc'>$verdi</th>";
    }
	
	if ($status == "5: I test") {
	echo "<th bgcolor='#9fbedf'>$verdi</th>";
    }
	
	if ($status == "6: Godkjent") {
	echo "<th class='success'>$verdi</th>";
    }
	
	if ($status == "7: I DSM") {
	echo "<th class='info'>$verdi</th>";
    }

	
	

	
}//foreach

	echo "</tr>";


	}//for
	
			$db->close();
?>


     
  

  
  
  
  
  
  
  
  	</tbody>
  </table>
</div><!--Slutt på tabell-->

</div> <!-- slutt på jumbotron -->
</div> <!-- slutt på container fluid -->
<?php

 include "../footer2.html" ; ?>


</body>
</html>