<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>



  <!-- Modal -->
  <div class="modal fade" id="feil" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Logg på Fletty</h4>
		  
        </div>
        <div class="modal-body row">
		<br>
    <form class="col-lg-12" action="" method="post">
	<div class="row">
		<div class="col-sm-8 form-group">
	<p style="color: red;">Feil brukernavn eller passord.</p>
	</div>
	<div class="col-sm-8 form-group">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="brukernavn" type="text" class="form-control" name="brukernavn" placeholder="Brukernavn" required>
    </div>
	</div>
	<div class="col-sm-8 form-group">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input id="password" type="password" class="form-control" name="password" placeholder="Passord" required>
    </div>
	</div>
	</div>
	
        </div>
        <div class="modal-footer">

		<button type="submit" name="logginn" class="btn btn-default">Logg inn</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
		</form>
      </div>
      
    </div>
  </div>


</body>
</html>

<?php
// Sjekker brukernavn og passord med sikkerhetsmekanismer som real escape string(ufarligjør noen spesialtegn), og prepared statetments
include "../../../koble_til_database.php" ;


session_start();
if(isset($_POST["logginn"])) {
	$mittBrukernavn =  mysqli_real_escape_string($db,$_POST['brukernavn']);
	$mittPassord =  mysqli_real_escape_string($db,$_POST['password']);
	
	//Spørring med placeholders (spørsmålstegn)
	
	$sqlsetning = " SELECT id FROM brukere";
	$sqlsetning .= " WHERE brukernavn=?";
	$sqlsetning .= " AND passord=?";
	
	//Lag en prepared statetment
	$statetment = $db->prepare($sqlsetning);
	
	// Bind innparametrene som skal sendes til databasen
	$statetment->bind_param("ss", $mittBrukernavn, $mittPassord);
	
	//Utfør spørring
    $statetment->execute();
    $statetment->store_result();
    

// innloggingsjekk
    if ($statetment->num_rows == 1) {
        
        $_SESSION['login_user'] = $mittBrukernavn;
        header("location: ../tabellhtml.php");
        exit();
    } else {
		echo "<script>$('#feil').modal('show')</script>";
		
    }

    $statetment->close();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $db->close();
}

?>