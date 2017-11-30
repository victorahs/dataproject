<?php
// load classes and libraries
require_once "libs.php";

function addCookie($keyRequest, $keyCookie, $time = 240000){
	if(isset($_REQUEST[$keyRequest])){
		$val = "".$_REQUEST[$keyRequest]."";
		setcookie("sessionFilter[".$keyCookie."]", $val, time() + $time, URL_SITE."/include/");
		return $val;
	}
	else{
		(isset($_COOKIE["sessionFilter"]["".$keyCookie.""])) ? $val = $_COOKIE["sessionFilter"]["".$keyCookie.""] : $val = null;
		return $val;
	}
}

// create cookies with searching information
$myCity = addCookie("city", "city");
$name = addCookie("etablissements", "name");
$longitude = addCookie("longitude", "longitude");
$latitude = addCookie("latitude", "latitude");

// delete cookies for types of handicap
$filterH = array('surdity','blind','mental','mobility');
foreach($filterH as $v) {
	setcookie("sessionFilter[".$v."]", "", time() -3600, URL_SITE."/include/");
}

// create cookies with filter selected
$filterNew = array();
if(isset($_POST["Filter"])){
	$filterH = array('surdity','blind','mental','mobility');
	foreach($filterH as $v) {
		if(isset($_POST[$v])){
			$fil = "{$_POST[$v]}";
			setcookie("sessionFilter[".$v."]", $fil, time() + 3600, URL_SITE."/include/");
			$filterNew[$v] = $_POST[$v];
		}
	}
}
elseif(isset($_COOKIE['sessionFilter'])){
	$filterNew = $_COOKIE["sessionFilter"];
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

if (!empty($myCity)) { //si on a choisi une ville
	$e = new establishment();
	$d["item"] = $e->findByCity($myCity, $filterNew);
	$d["LongitudeCarte"] = $e->d[0]['Longitude'];
	$d["LatitudeCarte"] = $e->d[0]['Latitude'];
	/*print_r($d);*/
}

elseif (!empty($name)){
	$e = new establishment($name);
	$d["item"] = $e->d;
	$d["LongitudeCarte"] = $e->d['Longitude'];
	$d["LatitudeCarte"] = $e->d['Latitude'];

}

elseif (!empty($longitude)&&!empty($latitude)) {
	$e = new establishment();
	$d["item"] = $e->findByCoord($longitude, $latitude);
	$d["LongitudeCarte"] = $longitude;
	$d["LatitudeCarte"] = $latitude;
}

//start the mustache engine
$m = new Mustache_Engine;
//render the template with the set result
echo $m->render($template, $d);
