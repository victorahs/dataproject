<?php
// load classes and libraries
require_once "libs.php";

// header("Location:".URL_SITE."include/template/resultats.html");


if(!empty($_REQUEST['city']))
{
	//priorité input ville
	$myCity = $_REQUEST['city'];

	// create cookie with data of search by city
	$allRequestCITY = "{$_REQUEST['city']}";
	setcookie("sessionFilterCITY[city]",  $allRequestCITY, time() + 120, URL_SITE."/include/getResults.php");

}
elseif(!empty($_REQUEST['etablissements']))
{
	$id = $_REQUEST['etablissements'];

	// create cookie with data of search by establishment
	$allRequestEST = "{$_REQUEST['etablissements']}";
	setcookie("sessionFilterEST[est]",  $allRequestEST, time() + 120, URL_SITE."/include/getResults.php");

}
else
{ //si aucune ville ou aucun établissement choisis
	$Longitude = $_REQUEST['longitude'];
	$Latitude = $_REQUEST['latitude'];
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	// create cookies for filter by type of handicap and for each search : city & establishement
	if(isset($_COOKIE['sessionFilterCITY']))
	{

		$Hauditory = "{$_POST['surdity']}";
		setcookie("sessionFilterCITY[auditoryFilter]", $Hauditory, time() + 240, URL_SITE."/include/getResults.php");

		$Hvisual = "{$_POST['blind']}";
		setcookie("sessionFilterCITY[visualFilter]", $Hvisual, time() + 240, URL_SITE."/include/getResults.php");

		$Hmobility = "{$_POST['mobility']}";
		setcookie("sessionFilterCITY[mobilityFilter]", $Hmobility, time() + 240, URL_SITE."/include/getResults.php");

		$Hmental = "{$_POST['mental']}";
		setcookie("sessionFilterCITY[mentalFilter]", $Hmental, time() + 240, URL_SITE."/include/getResults.php");

		// echo "<pre>";
		// print_r($_COOKIE['sessionFilterCITY']);
		// echo "</pre>";
	}
	else{
		exit;
	}

}





/*
 * result view
 */

//register mustache library
require 'libs/Mustache/Autoloader.php';
Mustache_Autoloader::register();

//set the template for Mustache
$template = file_get_contents("template/resultats.html");

//create a new object establishment

if (!empty($myCity)) { //si on a choisi une ville
	$e = new establishment();
	$d["item"] = $e->findByCity($myCity);
	$d["LongitudeCarte"] = $e->d[0]['Longitude'];
	$d["LatitudeCarte"] = $e->d[0]['Latitude'];

	//test filtre par ville
	$d["surdity"] = $e->findAccessSurdity();
	$d["blind"] = $e->findAccessBlind();
	$d["mobility"] = $e->findAccessMobility();
	$d["mental"] = $e->findAccessMental();

		print_r($e);
}

elseif (!empty($id)){
	$e = new establishment($id);
	$d["item"] = $e->d;
	$d["LongitudeCarte"] = $e->d['Longitude'];
	$d["LatitudeCarte"] = $e->d['Latitude'];

	//test filtre par ets
	$d["surdity"] = $e->findAccessSurdity();
	$d["blind"] = $e->findAccessBlind();
	$d["mobility"] = $e->findAccessMobility();
	$d["mental"] = $e->findAccessMental();

	print_r($e);
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


?>
