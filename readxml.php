<?php

//$fil = 'C:/uniserver/UniServerZ/www/nettside/Fletty/infofiler/'.$target_file;

// Henter ut informasjon fra ei METS info.xml fil.
// Dette er all informasjon: 
// institusjonsnavn, systemnavn, systemversjon, systemtype, metsprodusent(hvem har laget metsfila), uttrekksprodusent(hvem har laget uttrekket),
// personuttrekksprodusent(personnavn på hvem som har laget uttrekket), uttrekksapplikasjon(hva har uttrekksprodusenten brukt av verktøy),
// arkivskaper, eier(hvem eier uttrekket), arkivdepot(eks IKAk), avtaleNr (saksnummer?), startDato (på uttrekket), sluttDato, checksumtype,
// created(sjekksum ble laget), checksum, uttrekksize, filnavn, label, beskrivelse(content desc), datafil, filID (UUID fra essarch).
//


$dom = new DOMDocument();
$dom->load('infofiler/info.xml'); //eller target_file



$alleAgenter = $dom->getElementsByTagName( "agent" );
$list = array();
foreach($alleAgenter as $agent) {

$nameElement =  $agent->getElementsByTagName( "name" );
$name = $nameElement->item(0)->nodeValue;
$list[] = $name;

}


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
	
	$labelID = $labelBeskrivelse->getElementsByTagName( "div" );
	$label = $labelID->item(0)->getAttribute('LABEL');
	$beskrivelse = $labelID->item(1)->getAttribute('LABEL');
	$datafil = $labelID->item(2)->getAttribute('LABEL');
	$filID = $labelID->item(0)->getAttribute('LABEL');

}



if (count($list) > 0)
{
	
		print_r($filnavn); echo "<br>";
		print_r($avtaleNr);
		print_r($startDato);
		print_r($sluttDato);

						print_r($label);echo "<br>";
						print_r($beskrivelse);echo "<br>";
						print_r($datafil);echo "<br>";
						print_r($filID);echo "<br>";
}

?>
