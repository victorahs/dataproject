<?php

class establishment extends SQLpdo{

	public $d;
	private $sql;

	function __construct($name = null){

		$this->sql = new SQLpdo();

		if (!empty($name)){
			$this->d = $this->sql->fetch("SELECT * FROM `est_access2` WHERE `Name_Est`=:name", array(':name' => $name));
		}
	}

	function find($limit=null){
	/*renvoie TOUS les établissements*/
	// @param $limit integer Limite le nombre de résultat

	  	$sql = "SELECT * FROM `est_access2`";

		if(!empty($limit)) {
			$sql .= ' LIMIT '.$limit;
		}

		$this->d = $this->sql->fetchAll($sql);

	  	return $this->d ;
	 }

	function listCities($limit=null){
	/*renvoie TOUTES les villes*/

	  	$sql = "SELECT `City` FROM `est_access2` GROUP BY `City`";

		if(!empty($limit)) {
			$sql .= ' LIMIT '.$limit;
		}

		$this->d = $this->sql->fetchAll($sql);
  }

/*renvoie les établissements correspondant à une ville précise */
function findByCity($city, $filter = null){
	$array = array(':city' => $city);
	$__where_array = array(
		'surdity' => 'H_Auditory',
		'blind' => 'H_Visual',
		'mental' => 'H_Mental',
		'mobility' => 'H_Mobility');

	$req = "";

	if(is_array($filter)){

		$req = " AND ";
		static $i = 0;
		foreach($filter as $key => $val){

			if($key != "city" && $key != "etablissements" && $key != "longitude" && $key != "latitude"){

				if($i == 0){
					$req .= "(";
				}
				if($i > 0){
					$req .= " OR ";
				}
				 $req .= " ".$__where_array[$val]." = 1";
				$i ++;
			}
		}

		if($i > 0){
			$req .= ")";
		}
		else{
			$req .= "(".implode(" = 1 OR ", $__where_array)." = 1)";
		}
	}

	/*renvoie les établissements correspondant à une ville précise */
	$this->d = $this->sql->fetchAll("SELECT * FROM `est_access2` WHERE City=:city AND `Longitude` IS NOT NULL AND `Latitude` IS NOT NULL ".$req." ORDER BY `City` ", $array);

	return $this->d ;
}
	function findByCoord($Longitude, $Latitude){
	/*renvoie les établissements correspondant à une position GPS*/

		$perimeter = 0.15;

		$this->d = $this->sql->fetchAll("SELECT * FROM `est_access2` WHERE ( `Longitude` BETWEEN (:longitudeMin) AND (:longitudeMax)) AND  ( `Latitude` BETWEEN (:latitudeMin) AND (:latitudeMax)) ", array(':longitudeMin' => $Longitude-$perimeter, ':longitudeMax' => $Longitude+$perimeter, ':latitudeMin' => $Latitude-$perimeter, ':latitudeMax' => $Latitude+$perimeter));

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
