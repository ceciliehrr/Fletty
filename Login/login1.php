


  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-folder-open">  Fletty</span></button>    

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Logg på Fletty</h4>
        </div>
        <div class="modal-body row">
		<br>
    <form class="col-lg-12" action="Fletty/Login/login2.php" method="post">
	<div class="row">
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


