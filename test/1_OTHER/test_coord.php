<?php

require_once "include/vendor/autoload.php";
require_once "include/libs.php";

use maxh\Nominatim\Nominatim;

// cherche avec Nominatom sur adresse + pays + ville
function findPointGpsNominatim($e){

    $url = "http://nominatim.openstreetmap.org/";
    $nominatim = new Nominatim($url);

    $search = $nominatim->newSearch()
            ->street($e['Address'])
            ->country('France')
            ->city($e['City'])
//          ->postalCode($e['Postcode'])//Si le code postal et pas valide faire sans
            ->polygon('geojson')   //or 'kml', 'svg' and 'text'
            ->addressDetails();

    $result = $nominatim->find($search);

    $lat = $result[0]['lat'];
    $lon = $result[0]['lon'];

    return array(
        'latitude' => $lat,
        'longitude' => $lon
    );

}

// cherche avec google api nom + adresse + code postal + ville
function findPointGpsGapi($e){

    $address = $e['Name_Est'].','.' '.$e['Address'].' '.$e['Postcode'].' '.$e['City'].' '.',France';

    // Penser a encoder votre adresse
    $address = urlencode($address);

    // On prépare l'URL du géocodeur
    $geocoder = "http://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false";

    // On prépare notre requête
    $query = sprintf($geocoder,$address);

    // On interroge le serveur
    // Et on renvoie un tableau
    $results = json_decode(file_get_contents($query), true);


    $latitude = null;
    $longitude = null;
    $error = null;

    // on test si la requete a fonctionner
    if($results['status']=='OK'){

        $latitude = $results['results'][0]['geometry']['location']['lat'];
        $longitude = $results['results'][0]['geometry']['location']['lng'];

        return array(
        'latitude' => $latitude,
        'longitude' => $longitude,
        );

        }else{

            return false;

        }

}

// boucler sur les établissements avec foreach
$etablissement = new establishment();
$listeEtablissements = $etablissement->find();

foreach($listeEtablissements as $e) {
    // pas de lat ou pas long dans bdd

    if(empty($e['Longitude']) && empty($e['Latitude'])){



        echo 'Pour établissement '.$e['id'].' / '.$e['Name_Est'].' : <br>';
        echo '<span class="color: red;">Il manque Latitude ou Longitude</span><br>';

        echo 'Chercher les points avec Google Api<br>';
        $points = findPointGpsGapi($e);
    //    $points = findPointGpsNominatim($e);

        if($points != false) {
            echo 'Point trouvé pour établissement'.$e['id'].' <br>';
            $sqlpdo = new SQLpdo();
            $sqlpdo->updateDB($points['longitude'], $points['latitude'],$e['id']);

//

            }
            else {
                echo 'Points non trouvés sur Google Ap<br>';
            }


    sleep(1);
        }
}
