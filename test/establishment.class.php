<?php
// require_once "../libs.php";

class establishment extends SQLpdo{

	public $d;
	private $sql;

	function __construct($name = null){
		$this->sql = new SQLpdo();

		if (!empty($name)){
			// $this->d = $this->sql->fetch("SELECT * FROM `EST_Access2` WHERE id=:id", array(':id' => $id));

			$this->d = $this->sql->fetch("SELECT * FROM `EST_Access2` WHERE `Name_Est`=:name", array(':name' => $name));
		}
	}

	 // @param $limit integer Limite le nombre de résultat
 function find($limit=null){

 /*renvoie TOUS les établissements*/
  $sql = "SELECT * FROM `EST_Access2`";

        if(!empty($limit)) {
            $sql .= ' LIMIT '.$limit;
        }

        $this->d = $this->sql->fetchAll($sql);
  return $this->d ;
 }

/*
	function find(){
	renvoie TOUS les établissements WHERE `Longitude` IS NOT NULL AND `Latitude` IS NOT NULL
		$this->d = $this->sql->fetchAll("SELECT * FROM `EST_Access2`   ORDER BY `Name_Est`");
		return $this->d ;
	}
*/
/*renvoie les établissements correspondant à une ville précise */
function findByCity($city, $filter = null){
	 $array = array(':city' => $city);
	$__where_array = array(
		'blind' => 'H_Visual',
		'surdity' => 'H_Auditory',
		'mobility' => 'H_Mobility',
		'mental' => 'H_Mental');

	// $req = " AND ";
	//
	// if(!is_null($filter) && is_array($filter)){
	// 	foreach($filter as $key => $val){
	// 		static $i = 0;
	// 		if($key != "city"){
	// 		//if($__where_array[$val]){ //si jamais la ligne du dessous ne marche pas, tente celle-là
	// 		//if(in_array($val, $__where_array)){ //je ne sias pas si cette ligne marche
	// 			if($i == 0){
	// 				$req .= "(";
	// 			}
	// 			if($i > 0){
	// 				$req .= " OR ";
	// 			}
	// 			$req .= " ".$__where_array[$val]." = :".$val;
	// 			$array  = array_merge($array, array(':'.$val => 1));
	//
	// 			$i ++;
	// 		}
	// 	}
	//
	// 	if($i > 0){
	// 		$req .= ")";
	// 	}
	// }
/*renvoie les établissements correspondant à une ville précise */
//$this->d = $this->sql->fetchAll("SELECT * FROM `EST_Access2` WHERE city=:city AND `Longitude` IS NOT NULL AND `Latitude` IS NOT NULL ".$req." ORDER BY `City` ", $array);
	$this->d = $this->sql->fetchAll("SELECT * FROM `EST_Access2` WHERE city=:city AND `Longitude` IS NOT NULL AND `Latitude` IS NOT NULL  ORDER BY `City` ", $array);
	return $this->d ;
}

	function findByCoord($Longitude, $Latitude){
	/*renvoie les établissements correspondant à une position GPS*/
		$perimeter = 0.15;
		$this->d = $this->sql->fetchAll("SELECT * FROM `EST_Access2` WHERE ( `Longitude` BETWEEN (:longitudeMin) AND (:longitudeMax)) AND  ( `Latitude` BETWEEN (:latitudeMin) AND (:latitudeMax)) ", array(':longitudeMin' => $Longitude-$perimeter, ':longitudeMax' => $Longitude+$perimeter, ':latitudeMin' => $Latitude-$perimeter, ':latitudeMax' => $Latitude+$perimeter));
		return $this->d ;
	}

/*--- recupération d'info dans la BD ---*/
	function getName(){
	/*renvoie le nom de l'établissement*/
		return $this->d['Name_Est'];
	}

	function getMail(){
	/*renvoie l'adresse mail de l'établissement*/
		return $this->d['Email_Contact'];
	}

	function getSite(){
	/*renvoie le site web de l'établissement*/
		return $this->d['Siteweb'];
	}

	function getPhone(){
	/*renvoie le numero de tél de l'établissement + formatage numéro 10 chiffres*/
		return $this->d['Phone'];

	}

	function getFax(){
	/*renvoie le numero de fax de l'établissement + formatage numéro 10 chiffres*/
		return $this->d['Fax'];

	}

	function getPostcode(){
	/*renvoie le code postal de l'établissement*/
		return $this->d['Postcode'];

	}

	function getAddress(){
	/*renvoie l'adresse postale (numero + rue) de l'établissement*/
		return $this->d['Address'];
	}

	function getDepartment(){
	/*renvoie le departement de l'établissement*/
		return $this->d['Department'];
	}

	function getCity(){
	/*renvoie la ville de l'établissement*/
		return $this->d['City'];
	}

	function getActivity(){
	 /*renvoie le type d'activité de l'établissement*/
	    return $this->d['Activity'];
	 }

	 function findAccessSurdity(){
	 /*renvoie true si l'établissement est accessible aux malentendants, false sinon*/
	    return $this->d['H_Auditory'];
	}

	 function findAccessBlind(){
	 /*renvoie true si l'établissement est accessible aux malvoyants, false sinon*/
	    return $this->d['H_Visual'];
	}

	 function findAccessMobility(){
	 /*renvoie true si l'établissement est accessible aux PMR, false sinon*/
	    return $this->d['H_Mobility'];
	}

	 function findAccessMental(){
	 /*renvoie true si l'établissement est accessible aux ..., false sinon*/
	    return $this->d['H_Mental'];
	}

}
