<?php

require_once "vendor/autoload.php";
require_once("include/SQLpdo.php");
require_once("include/establishment.php");
require_once("include/libs.php");


use maxh\Nominatim\Nominatim;
//
//$url = "http://nominatim.openstreetmap.org/";
//$nominatim = new Nominatim($url);
//
//$search = $nominatim->newSearch()
//            ->street("5 rue d'Etueffont")
//
//            ->country('France')
//            ->city('Anjoutey')
//            ->postalCode('90170')
//            ->polygon('geojson') ;   //or 'kml', 'svg' and 'text'
////            ->addressDetails();
//
//
//$result = $nominatim->find($search);
//echo "<pre>";
//print_r($result);
//print_r($result[0]['lat']);
//print_r($result[0]['lon']);
//echo "</pre>";
//// phase de test

function updatePointGps(){
$id1=88745;
$estaTest = new establishment($id1);
$postCode = $estaTest->getPostcode();
$city=$estaTest->getCity();
$address=$estaTest->getAddress();
    
//use maxh\Nominatim\Nominatim;
print_r($postCode);
print_r($city);
print_r($address);

$url = "http://nominatim.openstreetmap.org/";
$nominatim = new Nominatim($url);

$search = $nominatim->newSearch()
            
            ->street("1 parvis des Droits de l'Homme")

            ->country('France')
            ->city('Metz')
//            ->postalCode('57000')
            ->polygon('geojson')   //or 'kml', 'svg' and 'text'
            ->addressDetails();

$result = $nominatim->find($search);

print_r($result);

$lat=$result[0]['lat'];
$lon=$result[0]['lon'];

print_r($lat);
print_r($lon);


//print_r($vivi);
//print_r($estaTest['postcode']);


}
updatePointGps();
    

