
<?php include "head.php"; ?>
<body>

<?php

include "navbar.php"; ?>
<div class="container-fluid">

<div class="jumbotron">
  <h1>Endre deponering</h1> 

  </div>


<br>
<?php
include "../../koble_til_database.php" ;
	
	// hvis knappen 'slett' er trykket på, slett raden med den ID'en
	if (isset($_POST['slett']) ) {
		//sletter en rad
		$sql = "DELETE FROM uttrekk WHERE id ='" . $_POST['id'] . "'";
		$resultat = $db->query($sql);
		echo "<div class='alert alert-warning'alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><h2> Raden ble slettet! </h2></div>";
		if (mysqli_error())
		 {
		echo "<div class='alert alert-danger'alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Error description: " . mysqli_error($db) . "</div>";
		 }
	}
	//hvis knappen 'endre' er trykket på, 
	elseif (isset($_POST['endre'] ) ) {
		//vis skjema og sett inn eksisterende verdier
		//skal endre raden, henter ut riktig id først
		 $sql = "SELECT * FROM uttrekk WHERE id = '" . $_POST['id'] . "'";
		 $resultat = $db->query($sql);
		 $rad = $resultat->fetch_assoc(); //får bare en rad
		 if (mysqli_error())
		 {
		 echo "Error description: " . mysqli_error($db);
		 }
			$db->close();
	?>


<!-- Skjema som sender informasjonen som blir endret til registrer_endringer.php -->
<form action="registrer_endringer.php" method="post" enctype="multipart/form-data" style="border: 1px solid grey; padding: 20px">
 <h1>Mottaksinformasjon</h1>
 <div class="row">
 <div class="form-group col-sm-4">
  <label>Status:*</label>
  <br>
  <select class="form-control" id="status" size="1" name="status">
  <option><?php echo $rad['status'];?></option>
  <option>1: Avtalt</option>
  <option>2: Mottatt</option>
  <option>3: I karantene</option>
  <option>4: Avvist, venter ny deponering</option>
  <option>5: I test</option>
  <option>6: Godkjent</option>
  <option>7: I DSM</option>
  </select>
 </div>
 </div>

   <div class="row">
     <div class="form-group col-sm-4">
      <label for="skjermet">Inneholder skjermet informasjon?</label>
      <select class="form-control" name="skjermet" id="skjermet">
	  <option><?php echo $rad['skjermet'];?></option>
        <option>Ja</option>
        <option>Nei</option>
        <option>Vet ikke</option>
      </select>
	  </div>
	  </div>
  
  <div class="row">
  <div class="form-group col-sm-4">
<label>Forventet ankomst</label>
  <div class="input-group input-append date">
  <input type="text" class="form-control datePicker" id="forventet" name="forventet" placeholder="YYYY/MM/DD" value="<?php echo $rad['forventetAnkomst']; ?> " />
  <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
</div>
</div>
</div>

    <div class="row">
  <div class="form-group col-sm-4">
<label>Mottatt dato</label>
  <div class="input-group input-append date">
  <input type="text" class="form-control datePicker" id="mottattdato" name="mottattdato" placeholder="YYYY/MM/DD" value="<?php echo $rad['mottattDATO']; ?> " />
  <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
</div>
</div>
</div>
 
    <div class="row">
  <div class="form-group col-sm-4">
  <label for="etikett">Etikett på avleveringsmediet:</label>
    <br>
  <input style="width: 400px;" class="form-control" type="text" id="etikett" name="etikett"  value="<?php echo $rad['etikett']; ?> "/>
  </div>
  </div>

     <div class="row">
  <div class="form-group col-sm-4">
  <label for="databaseplattform" >Databaseplattform:</label>
    <br>
  <input  style="width: 400px;" class="form-control" type="text" id="databaseplattform" name="databaseplattform" value=" <?php echo $rad['databaseplattform']; ?> "/>
  </div>
  </div>
    <div class="row">
  <div class="form-group col-sm-4">
  <label for="arkivleder" >Arkivleder:</label>
    <br>
  <input  style="width: 400px;" class="form-control" type="text" id="arkivleder" name="arkivleder" value=" <?php echo $rad['arkivleder'];  ?> "/>
  </div>
  </div>
  
     <div class="row">
  <div class="form-group col-sm-4">
  <label for="ansvarlig">Ansvarlig:*</label>
    <br>
  <input style="width: 400px;" class="form-control" type="text" id="ansvarlig" name="ansvarlig" value="<?php echo $bruker; ?>" disabled />
  </div>
</div>
  
      <h1>METS-informasjon</h1>
     <div class="row">
  <div class="form-group col-sm-4">
  <label for="arkivskaper">Arkivskaper:*</label>
    <br>
  <input style="width: 400px;"  class="form-control" type="text" id="arkivskaper" name="arkivskaper" value="<?php echo $rad['arkivskaper']; ?> " required/>
  </div>
</div>

    <div class="row">
  <div class="form-group col-sm-4">
<label>Start dato</label>
  <div class="input-group input-append date">
  <input type="text" class="form-control datePicker" id="startDato" name="startDato" placeholder="YYYY/MM/DD" value="<?php echo $rad['startDato']; ?> " />
  <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
</div>
</div>
</div>
  
    <div class="row">
  <div class="form-group col-sm-4">
<label>Slutt dato</label>
  <div class="input-group input-append date">
  <input type="text" class="form-control datePicker" id="sluttDato" name="sluttDato" placeholder="YYYY/MM/DD" value="<?php echo $rad['sluttDato']; ?> " />
  <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
</div>
</div>
</div>

    <div class="row">
  <div class="form-group col-sm-4">
  <label for="system">System:*</label>
    <br>
  <input style="width: 400px;" class="form-control" type="text"  id="system" name="system" value="<?php echo $rad['system']; ?> " required/>
  </div>
  </div>
    <div class="row">
  <div class="form-group col-sm-4">
  <label for="systemversjon">Systemversjon:</label>
    <br>
  <input style="width: 400px;" class="form-control" type="text"  id="systemversjon" name="systemversjon" value="<?php echo $rad['systemversjon']; ?> "/>
  </div>
  </div>
    <div class="row">
  <div class="form-group col-sm-4">
  <label for="systemtype">Systemtype:(eks Noark5)</label>
    <br>
  <input style="width: 400px;" class="form-control" type="text"  id="systemtype" name="systemtype" value="<?php echo $rad['systemtype']; ?> "/>
  </div>
</div>
    <div class="row">
  <div class="form-group col-sm-4">
  <label for="saksNR">Saksnummer:</label>
    <br>
  <input style="width: 400px;" class="form-control" type="text" id="saksNR" name="saksNR" value="<?php echo $rad['saksNR']; ?> "/>
  </div>
 </div>
    <div class="row">
  <div class="form-group col-sm-8">
  <label for="kommentar">Kommentar(Max 500 tegn): </label>
    <br>
  <textarea class="form-control" rows="10" id="kommentar" name="kommentar" maxlength="500"><?php echo $rad['kommentar']; ?></textarea>
  </div>
	</div>
	
	<input name="id" type="hidden" id="id" value="<?php echo $rad['id']; ?> "/>
    

    <div class="row">
  <div class="form-group col-sm-4">
        <button type="submit"  name="lagre" class="btn btn-default">Lagre og fortsett</button>
      </div>
	  </div>
  </form> <!-- Slutt på skjema -->
    <script>
$(document).ready(function() {
    $('input.datePicker')
        .datepicker({
            autoclose: true,
            format: 'yyyy/mm/dd'
        })
});
</script>
<?php 
	} //elseif
include "../footer2.html" ; ?>

</div>
</body>
</html>
