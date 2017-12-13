<?php include "head.php"; ?>

<script type="text/javascript">
function checkDelete(){
    return confirm('Er du sikker på at du vil slette?');
}
</script>
 <style> 
 #button {
	display:inline-block;
	vertical-align: middle;
	 
 }
 
 </style>


<body>
<?php include "navbar.php"; ?>
<div class="container-fluid">
<div class="jumbotron">
<h1>Deponeringer</h1> 
  <p>
</p> 

</div>


<br>

  <?php include "sokboksen.php"; ?>
  
  
  <table class="table table-hover">
    <thead>
      <tr>
       <th>ID</th>
		<th>Arkivskaper</th>
		<th>Status</th>
		<th>Start dato</th>
		<th>Slutt dato</th>
        <th>Saksnummer</th>
        <th>Mottattdato</th>
        <th>Forventet Ankomst</th>
        <th>System</th>
        <th>Ansvarlig</th>
		<th>Sist endret</th>
      </tr>
    </thead>
	<tbody>

<?php
include "../../koble_til_database.php" ;

if (isset($_POST['sok']) ) {
	

	$sorterEtter = $_POST['sorter'];

switch ($sorterEtter) {
	case "Avtalt":
	$sql = "SELECT id, arkivskaper, status, startDato, 
 sluttDato, saksNR, mottattDATO,forventetAnkomst, system, ansvarlig, sistendret FROM uttrekk WHERE status LIKE '%Avtalt%'";
	$resultat = $db->query($sql);
	$antall = $resultat->num_rows;
	  echo "Antall deponeringer: " . $antall . "<br /><br />";
	break;
	
	case "Mottatt":
	$sql = "SELECT id, arkivskaper, status, startDato, 
 sluttDato, saksNR, mottattDATO,forventetAnkomst, system, ansvarlig, sistendret FROM uttrekk WHERE status LIKE '%Mottatt%'";
	$resultat = $db->query($sql);
	$antall = $resultat->num_rows;
	  echo "Antall deponeringer: " . $antall . "<br /><br />";
	break;
	
	case "Karantene":
	$sql = "SELECT id, arkivskaper, status, startDato, 
 sluttDato, saksNR, mottattDATO,forventetAnkomst, system, ansvarlig, sistendret FROM uttrekk WHERE status LIKE '%Karantene%'";
	$resultat = $db->query($sql);
	$antall = $resultat->num_rows;
	  echo "Antall deponeringer: " . $antall . "<br /><br />";
	break;
	
	case "Avvist":
	$sql = "SELECT id, arkivskaper, status, startDato, 
 sluttDato, saksNR, mottattDATO,forventetAnkomst, system, ansvarlig, sistendret FROM uttrekk WHERE status LIKE '%Avvist%'";
	$resultat = $db->query($sql);
	$antall = $resultat->num_rows;
	  echo "Antall deponeringer: " . $antall . "<br /><br />";
	break;
	
	case "Itest":
	$sql = "SELECT id, arkivskaper, status, startDato, 
 sluttDato, saksNR, mottattDATO,forventetAnkomst, system, ansvarlig, sistendret FROM uttrekk WHERE status LIKE '%test%'";
	$resultat = $db->query($sql);
	$antall = $resultat->num_rows;
	  echo "Antall deponeringer: " . $antall . "<br /><br />";
	break;
	
	case "Godkjent":
	$sql = "SELECT id, arkivskaper, status, startDato, 
 sluttDato, saksNR, mottattDATO,forventetAnkomst, system, ansvarlig, sistendret FROM uttrekk WHERE status LIKE '%Godkjent%'";
	$resultat = $db->query($sql);
	$antall = $resultat->num_rows;
	  echo "Antall deponeringer: " . $antall . "<br /><br />";
	break;
	
	case "DSM":
	$sql = "SELECT id, arkivskaper, status, startDato, 
 sluttDato, saksNR, mottattDATO,forventetAnkomst, system, ansvarlig, sistendret FROM uttrekk WHERE status LIKE '%DSM%'";
	$resultat = $db->query($sql);
	$antall = $resultat->num_rows;
	  echo "Antall deponeringer: " . $antall . "<br /><br />";
	break;
	
	case "VisAlle":
	$sql = "SELECT id, arkivskaper, status, startDato, 
 sluttDato, saksNR, mottattDATO,forventetAnkomst, system, ansvarlig, sistendret FROM uttrekk ORDER BY status ASC";
	$resultat = $db->query($sql);
	$antall = $resultat->num_rows;
	  echo "Antall deponeringer: " . $antall . "<br /><br />";
	break;
	
	
	default:
	echo "Feil";
} //switch
	
	
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

	echo"<td>";

	echo "<form id='button' method='post' action='detaljer.php'>
			<input name='id' type='hidden'value='$id'/>
			<button type='submit' value='info' name='info' class='btn btn-info btn-xs' style='margin-bottom: 5px; margin-right: 3px'; >INFO</button>";
	echo "</form>";

	echo"<form  id='button' method='post' action='endre_rad.php'>
			<input name='id' type='hidden' value='$id'/>
			<button type='submit' value='Endre' name='endre' class='btn btn-primary btn-xs' style='margin-bottom: 5px; margin-right: 3px';>ENDRE</button>
			<button onclick='return checkDelete()' type='submit' value='slett' name='slett' class='btn btn-danger btn-xs' style='margin-bottom: 5px; margin-right: 3px'; >SLETT</button>
		</form></td>";
	echo "</tr>";

		
	} //for
}//if isset

		$db->close();
?>

	</tbody>
  </table>

</div> <!--Slutt på container-fluid-->






<?php include "../footer2.html" ; ?>


</body>
</html>
