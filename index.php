<?php
/*
 * Index file
 */

//register mustache library
require 'include/libs/Mustache/Autoloader.php';
Mustache_Autoloader::register();

// load classes and libraries
require_once "include/libs.php";


//set the template
$template = file_get_contents("include/template/index.html");

//create a new object establishment
$e = new establishment();

//recieve the entire list of establishment in our database
$d["eList"] = $e->listCities();


//start the mustache engine
$m = new Mustache_Engine;
//render the template with the set result
echo $m->render($template, $d);
