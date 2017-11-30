<?php
// load classes and libraries
require_once "libs.php";

//on crée un cookie pour enregistrer les différentes valeurs récupérées deuis de formulaire de l'index
setcookie("sessionFilter[city]", "" , time() + 120, URL_SITE."/include/getResults.php");
setcookie("sessionFilter[est]",  "", time() + 120, URL_SITE."/include/getResults.php");
setcookie("sessionFilter[longitude]",  "", time() + 120, URL_SITE."/include/getResults.php");
setcookie("sessionFilter[latitude]",  "", time() + 120, URL_SITE."/include/getResults.php");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	if(!empty($_REQUEST['city']))
	{
		//priorité choix de la ville
		$myCity = $_REQUEST['city'];
		// on enregistre la ville choisie
		$_COOKIE['sessionFilter[city']=$myCity ;
	}
	elseif(!empty($_REQUEST['etablissements']))
	{
		$name = "{$_REQUEST['etablissements']}";
		// on enregistre l'id de l'établissement choisi
		$_COOKIE['sessionFilter[est']=$name ;
	}
	else
	{ //si aucune ville ou aucun établissement choisis, on prend la géolocalisation

		$Longitude = $_REQUEST['longitude'];
		$Latitude = $_REQUEST['latitude'];
		// on enregistre les valeurs de longitude et latitude si elles existent

		$_COOKIE['sessionFilter[longitude]']=$Longitude ;
		$_COOKIE['sessionFilter[latitude]']=$Latitude ;
	}
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	// create cookies for filter by type of handicap and for only city's searching
	if(isset($_COOKIE['sessionFilter'])) // ce cookie est créé à la ligne 15
	{

		$Hauditory = "{$_POST['surdity']}";
		setcookie("sessionFilter[auditoryFilter]", $Hauditory, time() + 120, URL_SITE."/include/getResults.php");

		$Hvisual = "{$_POST['blind']}";
		setcookie("sessionFilter[visualFilter]", $Hvisual, time() + 120, URL_SITE."/include/getResults.php");

		$Hmental = "{$_POST['mental']}";
		setcookie("sessionFilter[mentalFilter]", $Hmental, time() + 120, URL_SITE."/include/getResults.php");

		$Hmobility = "{$_POST['mobility']}";
		setcookie("sessionFilter[mobilityFilter]", $Hmobility, time() + 120, URL_SITE."/include/getResults.php");

	}
	else{
		exit;
	}

}

/*
 result view
 */

//register mustache library
require 'libs/Mustache/Autoloader.php';
Mustache_Autoloader::register();

//set the template for Mustache
$template = file_get_contents("template/resultats.html");

//create a new object establishment
	if (isset($_COOKIE['sessionFilter'])) {
		$arrayFilter = $_COOKIE['sessionFilter'];
	}
	else {
		$arrayFilter = [];
	}

if (!empty($myCity)) { //si on a choisi une ville
	//print_r($arrayFilter);
	$e = new establishment();
	$d["item"] = $e->findByCity($myCity, $arrayFilter);
	$d["LongitudeCarte"] = $e->d[0]['Longitude'];
	$d["LatitudeCarte"] = $e->d[0]['Latitude'];
}

elseif (!empty($name)){
	$e = new establishment($name);
	$d["item"] = $e->d;
	$d["LongitudeCarte"] = $e->d['Longitude'];
	$d["LatitudeCarte"] = $e->d['Latitude'];

}

elseif (!empty($Longitude)&&!empty($Latitude)) {
	$e = new establishment();
	$d["item"] = $e->findByCoord($Longitude, $Latitude);
	$d["LongitudeCarte"] = $Longitude;
	$d["LatitudeCarte"] = $Latitude;
}
else{
	//echo "erreur choix nuls";
	exit;
}

//start the mustache engine
$m = new Mustache_Engine;
//render the template with the set result
echo $m->render($template, $d);
