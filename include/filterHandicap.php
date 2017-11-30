<?php
require_once("libs.php");

// setcookie('auditoryFilter', 'surdity', time() - 120, "/");
// setcookie('visualFilter', 'blind', time() - 120, URL_SITE);
// setcookie('mobilityFilter', 'mobility', time() - 120, URL_SITE);
// setcookie('mentalFilter', 'mental', time() - 120, URL_SITE);

$_COOKIE['auditoryFilter'] = $surdity;
$_COOKIE['visualFilter'] = $blind;
$_COOKIE['mobilityFilter'] = $mobility;
$_COOKIE['mentalFilter'] = $mental;


if($_SERVER['REQUEST_METHOD'] == 'POST'){
	// checking if input with post method exist
	if(filter_has_var(INPUT_POST, 'surdity') || filter_has_var(INPUT_POST, 'blind') || filter_has_var(INPUT_POST, 'mobility') || filter_has_var(INPUT_POST, 'mental')){

		$Hauditory = $_REQUEST['surdity'];
		$Hvisual = $_REQUEST['blind'];
		$Hmobility =  $_REQUEST['mobility'];
		$Hmental = $_REQUEST['mental'];

		if(isset($surdity) || isset($blind) || isset($mobility) || isset($mental)){

			$Hauditory = $surdity;
			$Hvisual = $blind;
			$Hmobility =  $mobility;
			$Hmental = $mental;
	}

	}
	else{ echo "erreur voir create cookie with input data";
	}
}
