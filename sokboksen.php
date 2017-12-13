  <!--Start på sortere-->
 <form class="form-inline" action="sortere.php" method="post" >
 <div class="form-group">
<label for="sorter" style="margin-right: 61px;">Søk etter status:</label>
<select class="form-control" name="sorter" id="sorter">
<option value="VisAlle">Vis alle</option> 
<option value="Avtalt">1: Avtalt</option> 
<option value="Mottatt">2: Mottatt</option>
<option value="Karantene">3: I karantene</option>
<option value="Avvist">4: Avvist, venter ny deponering</option>
<option value="Itest">5: I test</option>
<option value="Godkjent">6: Godkjent</option>
<option value="DSM">7: I DSM</option>
</select>
        <button type="submit" value="sok" name="sok" class="btn btn-default" ><i class="glyphicon glyphicon-search"></i></button>
      </div>
  </form>
  <!--Slutt på sortere-->
    <!--start på kommunesøk-->
<br>
  <form class="form-inline" action="sokKommune.php" method="post">
  <label for="sokKommune" style="margin-right: 26px;">Søk etter arkivskaper:</label>
  <div class="col-sm-3 input-group">
    <input name="sokKommune" type="text" class="form-control" placeholder="Søk">
    <div class="input-group-btn">
      <button class="btn btn-default" type="submit" name="search">
        <i class="glyphicon glyphicon-search"></i>
      </button>
    </div>
  </div>

</form>
<br>

  <!--Slutt på kommunesøk-->
  <!-- Start på systemsøk-->
    <form class="form-inline" action="sokSystem.php" method="post">
  <label for="sokSystem" style="margin-right: 55px;">Søk etter system:</label>
  <div class="col-sm-3 input-group">
    <input name="sokSystem" id="sokSystem" type="text" class="form-control" placeholder="Søk">
    <div class="input-group-btn">
      <button class="btn btn-default" type="submit" name="systemsok">
        <i class="glyphicon glyphicon-search"></i>
      </button>
    </div>
  </div>
</form>
<!--slutt på systemsøk-->
<br>
<form class="form-inline" action="visSlettede.php" method="post">
      <input style="float: right;"class="btn btn-default" type="submit" name="slettet" value="Vis slettede deponeringer">
        <!--<i class="glyphicon glyphicon-search"></i>-->
</form>
<br>
<br>
<hr>