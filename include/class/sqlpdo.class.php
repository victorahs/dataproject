<?php

class SQLpdo {
	private $db;

	function __construct(){
		try {
		    $this->db = new PDO('mysql:dbname='.DB.';host='.ADDRESS.'',LOGIN,MDP);
		} catch (PDOException $e) {
			// echo $e->getMessage();
			die();
		}

	}

	function fetchAll($sql,$execute=null){
		$sth = $this->db->prepare($sql);//prepare SQL request
	    $sth->execute($execute);//execute la requete sql
	    return $sth->fetchAll(PDO::FETCH_ASSOC);// recupère toutes les données
	}

	function fetch($sql,$execute=null){
		$sth = $this->db->prepare($sql);//prepare SQL request
	    $sth->execute($execute);//execute la requete sql
	    return $sth->fetch(PDO::FETCH_ASSOC);// recupère toutes les données
	}

	// Insérer toutes les données de la table
  	function insertData($docid, $nameEst, $emailEst, $siteweb, $phone, $fax, $Hauditory, $Hvisual, $Hmental, $Hmobility, $address, $postcode, $city, $department, $activity, $longitude=null, $latitude=null){

			$sql = "INSERT INTO `est_access2` (DocId , Name_Est, Email_Contact, Siteweb, Phone, Fax, H_Auditory, H_Visual, H_Mental, H_Mobility, Address, Postcode, City, Department, Activity, Longitude, Latitude)
			VALUES(:DocId, :nameEst, :emailEst, :siteweb, :phone, :fax, :Hauditory, :Hvisual, :Hmental, :Hmobility, :address, :postcode, :city, :department, :activity, :longitude, :latitude)";

		  $execute = array(
       ":DocId" => $docid,
       ":nameEst" => $nameEst,
       ":emailEst" => $emailEst,
       ":siteweb" => $siteweb,
       ":phone" => $phone,
       ":fax" => $fax,
       ":Hauditory" => $Hauditory,
       ":Hvisual" => $Hvisual,
       ":Hmental" => $Hmental,
       ":Hmobility" => $Hmobility,
       ":address" => $address,
       ":postcode" => $postcode,
       ":city" => $city,
       ":department" => $department,
       ":activity" => $activity,
			 ":longitude" => $longitude,
			 ":latitude" => $latitude
		 );
      try{
        $sth = $this->db->prepare($sql);
        $sth->execute($execute);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
      }
      catch (PDOException $e){
        // echo $e->getMessage();
        die();
      }
  	}


		function updateDB($longitude, $latitude, $id){
		   $sql = "UPDATE `est_access2`SET Longitude = :longitude, Latitude = :latitude  WHERE id=:id" ;
		   $execute = array(
		    ":id"=>$id,
		    ":longitude" => $longitude,
		    ":latitude" => $latitude
		   );

			try{
				$sth = $this->db->prepare($sql);
				$sth->execute($execute);
				return $sth->fetchAll(PDO::FETCH_ASSOC);
			}
			catch (PDOException $e){
				// echo $e->getMessage();
				die();
			}
		}

}
