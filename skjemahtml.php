
<?php include "head.php"; ?>

<body>

<?php

include "navbar.php";?>

<style type="text/css">

#eventForm .form-control-feedback {
    top: 0;
    right: -15px;
}
</style>

<div class="container-fluid">
<div class="jumbotron">
  <h1>Ny deponering</h1> 

  </div>

<?php include "lastopp.php"; ?>
</br>
<form action="nytt_uttrekk.php" method="post" enctype="multipart/form-data"  style="border: 1px solid grey; padding: 20px" id="eventForm">

<h1>Mottaksinformasjon</h1>
<br>
<div class="row">
  	<div class="form-group col-sm-4">
<label for="status">Status:</label>
<select class="form-control" name="status" id="status">
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
  <input type="text" class="form-control datePicker" id="forventet" name="forventet" placeholder="YYYY/MM/DD"/>
  <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
</div>
</div>
</div>

  <div class="row">
  <div class="form-group col-sm-4">
<label>Mottatt dato</label>
  <div class="input-group input-append date" id="datePicker">
  <input type="text" class="form-control datePicker" id="mottattdato" name="mottattdato" placeholder="YYYY/MM/DD"/>
  <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
</div>
</div>
</div>

  <div class="row">
  	<div class="form-group col-sm-4">
  <label for="etikett">Etikett på avleveringsmediet:</label>
  <input  type="text" class="form-control" id="etikett" name="etikett" />
  </div>
  </div>
  
    <div class="row">
   <div class="form-group col-sm-4">
  <label for="databaseplattform" >Databaseplattform:</label>
    <br>
  <input class="form-control" type="text" id="databaseplattform" name="databaseplattform" value=" <?php if(!empty($databaseplattform)){
  echo $databaseplattform;
  }  ?> "/>
  </div>
  </div>
  
    <div class="row">
  <div class="form-group col-sm-4">
  <label for="arkivleder" >Arkivleder:</label>
    <br>
  <input class="form-control" type="text" id="arkivleder" name="arkivleder" value=" <?php if(!empty($arkivleder)){
  echo $arkivleder;
  }  ?> "/>
  </div>
  </div>
  
    <div class="row">
    <div class="form-group col-sm-4">
  <label for="ansvarlig">Ansvarlig:*</label>
  <input type="text" class="form-control" id="ansvarlig" name="ansvarlig" value="<?php echo $bruker; ?>" disabled />
  </div>
  </div>
  
  <h1>METS-informasjon</h1>
<br>

  <div class="row">
   <div class="form-group col-sm-4">
  <label for="arkivskaper">Arkivskaper:*</label>
  <input type="text" class="form-control" id="arkivskaper" name="arkivskaper" value="<?php if(!empty($institusjonsnavn)){
  echo $institusjonsnavn;
  }  ?> <?php if(!empty($arkivskaper)){
  echo $arkivskaper;
  }  ?> " required />
  </div>
  </div>
  
    <div class="row">
  <div class="form-group col-sm-4">
  <label for="startDato">Start dato:</label>
    <div class="input-group input-append date">
  <input type="text" class="form-control datePicker" id="startDato" name="startDato" placeholder="YYYY/MM/DD" value="<?php if(!empty($startDato)){
  echo $startDato;
  }  ?> " />
    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
  </div>
  </div>
  </div>


    <div class="row">
    <div class="form-group col-sm-4">
  <label for="sluttDato">Slutt dato:</label>
      <div class="input-group input-append date">
  <input  type="text" class="form-control datePicker" id="sluttDato" name="sluttDato" placeholder="YYYY/MM/DD" value="<?php if(!empty($sluttDato)){
  echo $sluttDato;
  }  ?> " />
      <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
  </div> 
  </div>
  </div>
  
    <div class="row">
     <div class="form-group col-sm-4">
  <label for="system">System:*</label>
  <input type="text" class="form-control" id="system" name="system" value="<?php if(!empty($systemnavn)){
  echo $systemnavn;
  }  ?> " required />
  </div>
  </div>
  
    <div class="row">
     <div class="form-group col-sm-4">
  <label for="systemversjon">Systemversjon:</label>
  <input type="text" class="form-control" id="systemversjon" name="systemversjon"  value="<?php if(!empty($systemversjon)){
  echo $systemversjon;
  }  ?> "/>
  </div>
  </div>
  
    <div class="row">
     <div class="form-group col-sm-4">
  <label for="system">Systemtype(eks Noark 5)</label>
  <input type="text" class="form-control" id="systemtype" name="systemtype" value="<?php if(!empty($systemtype)){
  echo $systemtype;
  }  ?>  "/>
  </div>
  </div>
  
    <div class="row">
 <div class="form-group col-sm-4">
  <label for="saksnr">Saksnummer:</label>
  <input type="text" class="form-control" id="saksNR" name="saksNR" value=" <?php if(!empty($avtaleNr)){
  echo $avtaleNr;
  }  ?> "/>
  </div>
</div>

    <div class="row">
      	<div class="form-group col-sm-8">
  <label for="kommentar">Kommentar (max 500 tegn):</label>
  <textarea class="form-control" rows="10" id="kommentar" name="kommentar" maxlength="500"><?php if(!empty($kommentar)){
  echo $kommentar;
  }  ?> </textarea>
  </div>
  </div>
  
    <div class="row">
   <div class="form-group col-sm-4">
        <button type="submit" value="send" name="lagre" class="btn btn-default">Lagre og fortsett</button>
      </div>
	  </div>
  </form>
  <script>
$(document).ready(function() {
    $('input.datePicker')
        .datepicker({
            autoclose: true,
            format: 'yyyy/mm/dd'
        })

});
</script>
<?php include "../footer2.html" ; ?>

</div>
</body>
</html>
