/*--- Récupère la position GPS en live ---*/
    myPosition = document.getElementById("myPosition");

    function getCoords(position) {
      document.getElementById("Long").value = position.coords.longitude;
      document.getElementById("Lat").value = position.coords.latitude;
     }

    function errorMsg(error) {
      msg = {
       1: "Accès à la position non autorisé par le navigateur",
       2: "Position non trouvée",
       3: "Délai expiré"
      }
      myPosition.innerHTML = msg[error.code];
     }

     if (navigator.geolocation)
     {
      navigator.geolocation.getCurrentPosition(getCoords, errorMsg, {enableHighAccuracy:true, timeout:60*1000});
     }
     else
     {
      myPosition.innerHTML = "Géolocalisation non supportée par ce navigateur !";
     }
