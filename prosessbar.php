	<!-- Start på prosessbar -->
<style>
.prosessbar {
	margin-top: 10px;
	margin-bottom: 5px;
}
</style>
    <div class="prosessbar">
  <?php
  
include "../../koble_til_database.php" ;
  $id=$_POST['id'];


 $sql = "SELECT * FROM uttrekk WHERE id='$id'";
  $resultat = $db->query($sql);
  $antall = $resultat->num_rows;



for ($i = 0; $i<$antall; $i++) {
		$rad = $resultat->fetch_assoc();
		$id = $rad['id'];
  
		$prosess = $rad['status'];


if ($prosess == "1: Avtalt") { ?>

<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width:1%">
      Avtalt - 1% Complete
      </div>
  </div>
 
  
   <?php ;}
	
	elseif ($prosess == "2: Mottatt") { ?>
	<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width:15%">
      Motatt - 15% Complete
      </div>
  </div>

  <?php  ;}
	
	elseif ($prosess == "3: I karantene") { ?>
	<div class="progress">
    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:30%">
      I karantene - 30% Complete
    </div>
  </div>

    <?php ;}
	
	elseif ($prosess == "4: Avvist, venter ny deponering") { ?>
	<div class="progress">
    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width:5%">
      Avvist - 5% Complete
      </div>
  </div>

    <?php ; } 
	
	elseif ($prosess == "5: I test") { ?>
	<div class="progress">
    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
      I test - 50% Complete
       </div>
  </div>
    <?php ;}
	
	elseif ($prosess == "6: Godkjent") { ?>
	<div class="progress">
    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%">
      Godkjent - 90% Complete
      </div>
  </div>

    <?php ;}
	
	elseif ($prosess == "7: I DSM") { ?>
	<div class="progress">
    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
      100% Complete
    </div>
  </div>

    <?php ; } //end if 


	
	
	}//for
	$db->close();
  ?>

  </div><!--Slutt på prosessbar-->