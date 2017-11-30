<?php
function findByCity($city, $filter=null){

$where = "AND (";
$filter ="H_Auditory= 1 OR H_Visual= 1 OR H_Mental= 1 OR H_Mobility= 1";

for($i=0; $i < count($filter); $i++){

  if($filter[$i] = "H_Auditory"){
    $where = "AND (H_Auditory= 1";
    $this->d = $this->sql->fetchAll("SELECT * FROM `EST_Access2` WHERE city = :city '.$where.') AND `Longitude` IS NOT NULL AND `Latitude` IS NOT NULL ORDER BY `City`");

  }
  if($filter[$i] == "H_Visual"){
    $where = "AND (H_Visual= 1";
    $this->d = $this->sql->fetchAll("SELECT * FROM `EST_Access2` WHERE city = :city '.$where.') AND `Longitude` IS NOT NULL AND `Latitude` IS NOT NULL ORDER BY `City`");
  }

  if($filter[$i] == "H_Mental"){
    $where = "AND (H_Mental= 1";
    $this->d = $this->sql->fetchAll("SELECT * FROM `EST_Access2` WHERE city = :city '.$where.') AND `Longitude` IS NOT NULL AND `Latitude` IS NOT NULL ORDER BY `City`");
  }

  if($filter[$i] == "H_Mobility"){
    $where = "AND (H_Mobility= 1";
    $this->d = $this->sql->fetchAll("SELECT * FROM `EST_Access2` WHERE city = :city '.$where.') AND `Longitude` IS NOT NULL AND `Latitude` IS NOT NULL ORDER BY `City`");
  }
  elseif ($filter[$i] == "") {
    $this->d = $this->sql->fetchAll("SELECT * FROM `EST_Access2` WHERE city = :city AND `Longitude` IS NOT NULL AND `Latitude` IS NOT NULL ORDER BY `City`");
  }
  else{
    $where = "AND (H_Auditory= 1 OR H_Visual= 1 OR H_Mental= 1 OR H_Mobility= 1";
    $this->d = $this->sql->fetchAll("SELECT * FROM `EST_Access2` WHERE city = :city '.$where.') AND `Longitude` IS NOT NULL AND `Latitude` IS NOT NULL ORDER BY `City`");
  }

}
// $this->d = $this->sql->fetchAll("SELECT * FROM `EST_Access2` WHERE city = :city AND `Longitude` IS NOT NULL AND `Latitude` IS NOT NULL ORDER BY `City`", array(':city' => $city));

return $this->d ;
}
