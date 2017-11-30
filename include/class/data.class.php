<?php

class csvparser extends SQLpdo{

    private $data;
    private $delimeter;
    private $handle;

    function __construct($filename){
        $this->initFile($filename);
    }

    // Initialiser le fichier CSV
    function initFile($filename){

        $filename = $filename.'.csv';

        if(file_exists($filename)){

          // segmentation des données du fichier csv
            $this->handle = explode("\n", file_get_contents($filename));
            $this->data = array();
            $this->delimeter = "|";
          //  $this->filesize = filesize($filename);
        } else {
            echo 'Le fichier '.$filename.' introuvable';
            exit;
        }
        return false;
    }

    // Parser le fichier CSV
    function parse(){


        // si le fichier n'est pas vide
        if(!empty($this->handle)){

            // récupèrer les noms des colonnes sur la première ligne
            $fields = explode($this->delimeter, $this->handle[0]);
            //print_r($fields);
            foreach($fields as $kf=>$vf) {
              $fields[$kf] = trim($vf);
            }

            // supprimer la première ligne du tableau $this->handle
            unset($this->handle[0]);

            $i = 0; // compteur

            // on parcours les lignes
            foreach($this->handle as $row) {

                // on explose une ligne
                $cols = explode($this->delimeter, $row);

    // on remplace les index numériques par les noms de la premièrte colonne (tableau $fields);
                foreach($cols as $k => $v) {

                    $globalData[$fields[$k]]= trim($v);

                }

                // on place la ligne dans un tableau data
                $this->data[$i] = $globalData;
                $i++;

            }
        }
        return $this->data;
 }


 function __destruct(){
     unset($this->data);
 }

}
