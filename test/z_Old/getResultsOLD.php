<?php
//**********************************
//pensez à checker si $_REQUEST['etablissements'] existe
//**********************************
if(!empty($_REQUEST['city'])){
	//priorité input ville
	$myCity = $_REQUEST['city'];
}
elseif(!empty($_REQUEST['etablissements'])){
	$id = $_REQUEST['etablissements'];
}
else{
	echo "erreur Null x 2";
	exit;
}



/*
 * result view
 */

//register mustache library
require 'libs/Mustache/Autoloader.php';
Mustache_Autoloader::register();


// load classes and libraries
require_once "libs.php";


//set the template
$template = file_get_contents("template/resultats.html");

//create a new object establishment
//$e
if (!empty($myCity)) { //si on a choisi une ville
	$e = new establishment();
	$d["item"] = $e->findByCity($myCity);
	$d["LongitudeCarte"] = $e->d[0]['Longitude'];
	$d["LatitudeCarte"] = $e->d[0]['Latitude'];

}
elseif (!empty($id)){
	$e = new establishment($id);
	$d["item"] = $e->d;
	$d["LongitudeCarte"] = $e->d['Longitude'];
	$d["LatitudeCarte"] = $e->d['Latitude'];}
else{
	echo "erreur choix nuls";
	exit;
}

//start the mustache engine
$m = new Mustache_Engine;
//render the template with the set result
echo $m->render($template, $d);



?>
