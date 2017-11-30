<?php
mb_internal_encoding("UTF-8");

require_once("../libs.php");

$csv = new csvparser("TourismeHandicap-Etablissements-janvier2017");
$data = $csv->parse();

$emptyLink = "http://";

$dataB = new SQLpdo();

foreach($data as $field){

    // tri de l'activité par Lieu de visite
    if($field['ACTIVIT'] === "Lieu de visite"){
       $field['ACTIVIT'] = htmlspecialchars($field['ACTIVIT']);
    } else {
      continue; // on passe à l'item suivant directement sans faire les autres traitements
    }

  /* suppression des lignes dont les valeurs sont erronées*/
  if($field['DOCID'] === 0){
    // $field['DOCID'] = null;
    unset($field['DOCID']);
  }

  $field['ETABLISSEMENT'] = htmlspecialchars($field['ETABLISSEMENT']);

  /* validation de l'email */
  if(filter_var($field['EMAILCONTACT'], FILTER_VALIDATE_EMAIL)){
    $field['EMAILCONTACT'];
  } else{
    $field['EMAILCONTACT'] = null;
  }

  /* suppression des champs siteweb non renseignés */
  if($field['SITEWEB'] === $emptyLink){
    $field['SITEWEB']= null;
  }

  /* formatage phone number*/
  $nbcar = strlen($field['TELEPHONE']);
  if($nbcar < 9){ // num = vide ou  avec - de 9 chiffres > num invalide
    $field['TELEPHONE'] = null;
  } else {
      if($nbcar > 9) { //si 10 chiffres ou +, on ne conserve que 9 chiffres
        $field['TELEPHONE'] = substr($field['TELEPHONE'], $nbcar-9);
      }
      /*on ajoute +33 au num aux 9 chiffres du tel*/
      $field['TELEPHONE'] ='+33'.$field['TELEPHONE'];
  }

  /* formatage fax number*/
  $nbcar = strlen($field['FAX']);
  if($nbcar < 9){ // num = vide ou  avec - de 9 chiffres > num invalide
    $field['FAX'] = null;
  } else{
      if($nbcar > 9) { //si 10 chiffres ou +, on ne conserve que 9 chiffres
        $field['FAX'] = substr($field['FAX'], $nbcar-9);
      }
      /*on ajoute +33 au num aux 9 chiffres du tel*/
      $field['FAX'] ='+33'.$field['FAX'];
    }

    // vérification du code postal = 5 chiffres maxi -> supprimer sinon
    $nbcar = strlen($field['CODEPOSTAL']);

    if($nbcar < 5) { //on ajoute un 0 avant le numéro
      $field['CODEPOSTAL'] ='0'.$field['CODEPOSTAL'];
    } elseif ($nbcar > 5) {
      $field['CODEPOSTAL'] ='0'.substr($field['CODEPOSTAL'], $nbcar-4);
    }

     $field['ADRESSE'] = htmlspecialchars($field['ADRESSE']);

     // séparation des types d'handicap
     // transformer en array les handicaps
     $h = explode(';', $field['HANDICAPS']);

     // parcourir ce array créé pour en créer un nouveau
     $handicaps = array();

     foreach($h as $k => $v) {
       // supprimer les espaces avec trim()
       $handicap = trim($v);
       // mettre dans un tableau les types d'handicaps de la ligne
       $handicaps[$handicap] = $handicap;
    }

    $typeHandicaps = array(
      'auditif',
      'visuel',
      'mental',
      'moteur'
    );

    // parcourir les types de handicap
    foreach($typeHandicaps as $typeHandicap) {
        if(!empty($handicaps[$typeHandicap])) {
            $field[$typeHandicap] = 1;
          // valeur true
        }
        else {
            $field[$typeHandicap]  = 0;
              // valeur false
        }
    }

    // suppression des espaces
    $field['VILLE'] = trim($field['VILLE']);
    $field['DEPARTEMENT'] = trim($field['DEPARTEMENT']);

    echo "Enregistrement de ".$field['DOCID']."<br>";

    $dataB->insertData(
      $field['DOCID'],
      $field['ETABLISSEMENT'],
      $field['EMAILCONTACT'],
      $field['SITEWEB'],
      $field['TELEPHONE'],
      $field['FAX'],
      $field['auditif'],
      $field['visuel'],
      $field['mental'],
      $field['moteur'],
      $field['ADRESSE'],
      $field['CODEPOSTAL'],
      $field['VILLE'],
      $field['DEPARTEMENT'],
      $field['ACTIVIT']
    );

}
