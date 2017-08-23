<form action="lastoppxml.php" method="post" enctype="multipart/form-data" name="typefil"
onsubmit="return knappOK()">
    <h4>Hent fil:</h4>
    <input type="file" name="fileToUpload" id="fileToUpload">
    
	<br>
	<h4>Velg type fil</h4>
    <label class="radio-inline" >
      <input type="radio" value="metsfil" name="optradio" id="mets">Metsfil
    </label>
    <label class="radio-inline">
      <input type="radio" value="infofil" name="optradio" id="info">IKA Kongsberg infofil
    </label>
	<br>
	<br>
	<input type="submit" value="Last opp fil" name="submit">
  </form>
<script>
  function knappOK(){
    var e=document.getElementById("mets").checked ;//alert(e)
    var a=document.getElementById("info").checked ;
	if(!e && !a){
        alert("Type fil ikke valgt");
        return false;
    }
}
</script>