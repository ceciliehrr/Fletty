  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php

if(isset($_POST['submit']) && $_FILES['fileToUpload']['size'] > 0 )
{


// Finner informasjon om fila, navn og størrelse, type. 	
$filsize = $_FILES['fileToUpload']['size'];
$target_dir = "infofiler/"; // Hvor vil du ha fila?
$fila = $target_dir . basename($_FILES["fileToUpload"]["name"]); //Henter navnet på fila
$uploadOk = 1;
$FileType = pathinfo($fila,PATHINFO_EXTENSION); // Lager en filsti med filtypen
$target_file = $target_dir . uniqid() . '.' . $FileType; // Lager en unik id på fila med filtype
$tmpName = $_FILES['fileToUpload']['tmp_name'];

// Check if file already exists
if (file_exists($fila)) {
    echo "<div class='alert alert-danger'alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	Sorry, file already exists.</div>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "<div class='alert alert-danger'alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	Sorry, your file is too large.</div>";
    $uploadOk = 0;
}
// Allow certain file formats
if($FileType != "xml" && $FileType != "txt" && $FileType != "XML" && $FileType != "TXT" ) {
    echo "<div class='alert alert-danger'alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	Sorry, only XML and txt files are allowed.</div>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<div class='alert alert-danger'alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	Sorry, your file was not uploaded </div>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<div class='alert alert-success alert-dismissible' role='alert'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</div>";
//linux->>> chmod($target_file, 0777);
    } else {
        echo "<div class='alert alert-danger'alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Sorry, there was an error uploading your file.</div>";
    }
}



//sjekker om xml er korrekt
/*
libxml_use_internal_errors(true);
$xml = simplexml_load_string($target_file);
if ($xml === false) {
    echo "Failed loading XML: ";
    foreach(libxml_get_errors() as $error) {
        echo "<br>", $error->message;
    }
} else {
    print_r($xml);
}*/

// Lagrer informasjon om infofila i en tabell, om alle valideringene over gikk igjennom.

if ($uploadOk == 1)
{

include "../../koble_til_database.php" ;

$sql = "INSERT INTO infofiler(filnavn, filtype, filsize)
			VALUES ('$target_file', '$FileType', '$filsize')
";

if ($db->query($sql)) {
	echo "<div class='alert alert-success alert-dismissible' role='alert'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
	echo "<h4 class='alert-heading'>Fila lagret i databasen</h4>";
	echo "<p> Spørringen:<p/>";
	echo "<blocknote>$sql</blocknote>";
	echo "<p>ble utført</p>";
	echo "</div>";

}
else {
	echo "<div class='alert alert-danger'alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><p> Noe gikk galt</p>";
	echo "Error description: " . mysqli_error($db) . "</div>";
}

$db->close();



} //if isset 

session_start();

$_SESSION['filnavn'] = $target_file;




//slutt på sjekk av xml og upload fil til database


// START putter informasjon fra fil og inn i skjema

// Henter ut informasjon fra ei METS info.xml fil.
// Dette er all informasjon: 
// institusjonsnavn, systemnavn, systemversjon, systemtype, metsprodusent(hvem har laget metsfila), uttrekksprodusent(hvem har laget uttrekket),
// personuttrekksprodusent(personnavn på hvem som har laget uttrekket), uttrekksapplikasjon(hva har uttrekksprodusenten brukt av verktøy),
// arkivskaper, eier(hvem eier uttrekket), arkivdepot(eks IKAk), avtaleNr (saksnummer?), startDato (på uttrekket), sluttDato, checksumtype,
// created(sjekksum ble laget), checksum, uttrekksize, filnavn, label, beskrivelse(content desc), datafil, filID (UUID fra essarch).
//
$typeFil = $_POST['optradio'];

if ($typeFil == 'metsfil') {

$fil = 'C:/uniserver/UniServerZ/www/nettside/Fletty/'.$target_file;
$dom = new DOMDocument();
$dom->load($fil);

$alleAgenter = $dom->getElementsByTagName( "agent" );
$list = array();
foreach($alleAgenter as $agent) {

$nameElement =  $agent->getElementsByTagName( "name" );
$name = $nameElement->item(0)->nodeValue;
$list[] = $name;

}
/*
if (count($list) > 0) {

print_r($list);

}
*/ //printer ut array lista


$institusjonsnavn = $list[0];   //All informasjon om uttrekket
$systemnavn = $list[1];
$systemversjon = $list[2];
$systemtype = $list[3];
$metsprodusent = $list[4];
$uttrekksprodusent = $list[5];
$personuttrekksprodusent = $list[6];
$uttrekksapplikasjon = $list[7];
$arkivskaper = $list[8];
$arkivleder = $list[9];
$eier = $list[10];
$arkivdepot = $list[11];


$navn = $dom->getElementsByTagName( "altRecordID" );


$avtaleNr = $navn->item(0)->nodeValue;  // Informasjon om uttrekket
$startDato = $navn->item(1)->nodeValue;
$sluttDato = $navn->item(2)->nodeValue;



$alleFiler = $dom->getElementsByTagName( "file" ); 
foreach($alleFiler as $fil) {
$checksumtype =  $fil->getAttribute( "CHECKSUMTYPE" );  //All informasjon om uttrekksfila
$created = $fil->getAttribute("CREATED");
$checksum = $fil->getAttribute("CHECKSUM");
$uttrekksize = $fil->getAttribute("SIZE");
}


$navn = $dom->getElementsByTagName( "FLocat" );
foreach($navn as $filNavn) {
$filnavn = $filNavn->getAttribute("xlink:href");  //Informasjon om filnavn
}



$labelID = $dom->getElementsByTagName( "structMap" );
foreach($labelID as $labelBeskrivelse) {
	
	$labelID = $labelBeskrivelse->getElementsByTagName( "div" ); //informasjon om uttrekket
	$label = $labelID->item(0)->getAttribute('LABEL');
	$kommentar = $labelID->item(1)->getAttribute('LABEL');
	$datafil = $labelID->item(2)->getAttribute('LABEL');
	$filID = $labelID->item(0)->getAttribute('LABEL');

}


}// if metsfil slutt
// Hvis fila er en infofil hent ut verdiene

elseif ($typeFil == 'infofil') {

$fil = 'C:/uniserver/UniServerZ/www/nettside/Fletty/'.$target_file;
$dom = new DOMDocument();
$dom->load($fil);

$x = $dom->getElementsByTagName("navn");
$arkivleder = $x->item(0)->nodeValue;

$x = $dom->getElementsByTagName("telefon");
$telefonnummer = $x->item(0)->nodeValue;

$x = $dom->getElementsByTagName("arkivskaper");
$arkivskaper = $x->item(0)->nodeValue;

$x = $dom->getElementsByTagName("uttrekksdato");
$uttrekksdato = $x->item(0)->nodeValue;

$x = $dom->getElementsByTagName("metode");
$uttrekksapplikasjon = $x->item(0)->nodeValue;

$x = $dom->getElementsByTagName("produsent");
$uttrekksprodusent = $x->item(0)->nodeValue;

$x = $dom->getElementsByTagName("systemType");
$systemtype = $x->item(0)->nodeValue;

$x = $dom->getElementsByTagName("databaseplattform");
$databaseplattform = $x->item(0)->nodeValue;

$x = $dom->getElementsByTagName("filnavn");
$filnavn = $x->item(0)->nodeValue;

$x = $dom->getElementsByTagName("sjekksum");
$checksum = $x->item(0)->nodeValue;

$x = $dom->getElementsByTagName("algoritme");
$checksumtype = $x->item(0)->nodeValue;

$x = $dom->getElementsByTagName("kommentar");
$kommentar = $x->item(0)->nodeValue;



/*$arkivskaperinfo = $dom->getElementsByTagName( "arkivskaperInfo" );
foreach($arkivskaperinfo as $arkivskaperInfo) {
	$navn = $arkivskaperInfo->getElementsByTagName( "kontaktperson" );
	$kontaktperson = $navn->getElementsByTagName("navn");
	$telefonnummer = $navn->getElementsByTagName("telefon");
	$arkivskaper = $arkivskaperInfo->getElementsByTagName("arkivskaper");
	echo " " . $navn . " - " . $kontaktperson . " - " . $telefonnummer . " ";


	} 	*/

	

} //elseif
} //if upload = 1


	// $db->close();  //Slutt
?>

<!-- Skjema med informasjonen fra opplastet infoxml -->
<?php include "skjemahtml.php" ; ?>


	
