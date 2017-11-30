<?php

// ini_set('session.use_cookies', '1');// param DANS .HTACCES PAS ENCORE SAISI
// if(session_id() === true){
//
//   setcookie("sessionFilterCITY[city]",  "", time() - 120, URL_SITE."/include/getResults.php");
//
//   setcookie("sessionFilterEST[est]",  "", time() - 120, URL_SITE."/include/getResults.php");
//
// 	setcookie("sessionFilterCITY[auditoryFilter]", "", time() - 120, URL_SITE."/include/getResults.php");
//   setcookie("sessionFilterCITY[visualFilter]", "", time() - 120, URL_SITE."/include/getResults.php");
//   setcookie("sessionFilterCITY[mentalFilter]", "", time() - 120, URL_SITE."/include/getResults.php");
//   setcookie("sessionFilterCITY[mobilityFilter]", "", time() - 120, URL_SITE."/include/getResults.php");
//
//   session_destroy();
//
// }
//
// else{
  session_start();
//
// }

require_once(".init.php");
require_once("class/sqlpdo.class.php");
require_once("class/data.class.php");
require_once("class/establishment.class.php");
