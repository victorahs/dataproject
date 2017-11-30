<?php
//require_once "../libs.php";

class establishment extends SQLpdo{

	public $d;
	private $sql;

	function __construct($id = null){
		$this->sql = new SQLpdo();

		if (!empty($id)){
			$this->d = $this->sql->fetch("SELECT * FROM `EST_Access2` WHERE id=:id", array(':id' => $id));
		}
	}



	function find(){
	/*renvoie TOUS les établissements*/
		$this->d = $this->sql->fetchAll("SELECT * FROM `EST_Access2` AND `Longitude` IS NOT NULL AND `Latitude` IS NOT NULL ASC Name_Est");
		return $this->d ;
	}

	function findByCity($city){
	/*renvoie les établissements correspondant à une ville précise*/
		$this->d = $this->sql->fetchAll("SELECT * FROM `EST_Access2` WHERE city=:city AND `Longitude` IS NOT NULL AND `Latitude` IS NOT NULL ASC Name_Est", array(':city' => $city));
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

	 function isAccessSurdity(){
	 /*renvoie true si l'établissement est accessible aux malentendants, false sinon*/
	    return $this->d['H_Auditory'];
	}

	 function isAccessBlind(){
	 /*renvoie true si l'établissement est accessible aux malvoyants, false sinon*/
	    return $this->d['H_Visual'];
	}

	 function isAccessMobility(){
	 /*renvoie true si l'établissement est accessible aux PMR, false sinon*/
	    return $this->d['H_Mobility'];
	}

	 function isAccessMental(){
	 /*renvoie true si l'établissement est accessible aux ..., false sinon*/
	    return $this->d['H_Mental'];
	}

}
