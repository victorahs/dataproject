<!DOCTYPE html>
<html>
<head>
	<title>test class Establishment</title>
	<meta charset="utf-8">
</head>
<body>

<?php

/*--- fichier tests de class establishment ---*/

require_once "../include/libs.php";
$rtl = "<br/>";


function testValue($value1, $value2){
$rtl = "<br/>";
	if( $value1 == $value2) {	echo 'OK'.$rtl;	} 
	else {	echo 'Erreur'.$rtl;	}	
}

function testBool($value1){
$rtl = "<br/>";
	if( $value1 ) {	echo 'OK'.$rtl;	} 
	else {	echo 'Erreur'.$rtl;	}	
}



function testValues($e,$result){
	$esp = " > ";
	$rtl = "<br/>";

	print_r('nom = '.$e->getName().$esp); 				testValue($e->getName(), $result['name']);
	print_r('email = '.$e->getMail().$esp); 			testValue($e->getMail(), $result['mail']);
	print_r('website = '.$e->getSite().$esp);			testValue($e->getSite(), $result['site']);
	print_r('tel = '.$e->getPhone().$esp);				testValue($e->getPhone(), $result['phone']);
	print_r('fax = '.$e->getFax().$esp);				testValue($e->getFax(), $result['fax']);
	print_r('code = '.$e->getPostcode().$esp);			testValue($e->getPostcode(), $result['code']);
	print_r('address = '.$e->getAddress().$esp);		testValue($e->getAddress(), $result['address']);
	print_r('dept = '.$e->getDepartment().$esp);		testValue($e->getDepartment(), $result['dept']);
	print_r('city = '.$e->getCity().$esp);				testValue($e->getCity(), $result['city']);
	print_r('activity = '.$e->getActivity().$esp);		testValue($e->getActivity(), $result['activity']);
	print_r('defth = '.$e->isAccessSurdity().$esp);		testValue($e->isAccessSurdity(), $result['defth']);
	print_r('blind = '.$e->isAccessBlind().$esp);		testValue($e->isAccessBlind(), $result['blind']);
	print_r('mobility = '.$e->isAccessMobility().$esp);	testValue($e->isAccessMobility(), $result['mobility']);
	print_r('mental = '.$e->isAccessMental().$esp);		testValue($e->isAccessMental(), $result['mental']);
}


$id1 = 79474;
$result1 = array(
		'name' => "Gîte Ferme de Montépin",
		'mail' => 'montepin@wanadoo.fr',
		'site' => "http://www.gites-de-France-ain.com",
		'phone' => "385305484",
		'fax' => "",
		'code' => "1380",
		'address' => "1790 route de Montépin",
		'dept' => "AIN",
		'city' => "BAGÉ LA VILLE",
		'activity' => "Meublé de tourisme",
		'defth' => "true",
		'blind' => "true",
		'mobility' => "true",
		'mental' => "true"
	);

$e = new establishment($id1);
echo 'id = '.$id1.$rtl.$rtl;

testValues($e, $result1);

?>
-------------------------------
<?php 
/*$id1 = 79477;
$result1 = array(
		'name' => "Gîte rural La Fora",
		'mail' => 'gitelafora@gmail.com',
		'site' => "http://www.gite-lafora.com",
		'phone' => "678260963",
		'fax' => "474375944",
		'code' => "1100",
		'address' => "La Fora",
		'dept' => "AIN",
		'city' => "BAGÉ LA VILLE",
		'activity' => "Meublé de tourisme",
		'defth' => "true",
		'blind' => "true",
		'mobility' => "false",
		'mental' => "false"
	);

$e = new establishment($id1);
echo 'id = '.$id1.$rtl.$rtl;

testValues($e, $result1);

*/
?>

</body>
</html>





