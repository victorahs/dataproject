//api leafleft



var mymap = L.map('mapid').setView([47.633331, 6.86667], 13);// definition de la map avec point de coordonnées


  

  /*type de "tiles" pour la map, on peut en changer (skin)*/
  L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoidmljdG9yeXNoIiwiYSI6ImNpeTVzdGI4MTAwMnMyd3J2OXZ3emdkeWcifQ.T7A873FB8CceQ5KvcO943Q', {
  maxZoom: 18,
  attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
   '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
   'Imagery © <a href="http://mapbox.com">Mapbox</a>',
  id: 'mapbox.streets'
  }).addTo(mymap);



var popup = L.popup({minWidth:100},{keepInView:"true"})
.setContent('<p>Hello world!<br />This is a nice popup.</p>');

var marker = L.marker([47.6379311, 6.861552399999937]).addTo(mymap);
marker.bindPopup(popup);



var popup2 = L.popup({minWidth:100},{keepInView:"true"})
.setContent('<p>My cats eat a lizard<br />This is a nice popup 2.</p>');
  
var marker2 = L.marker([47.8, 6.6]).addTo(mymap);
marker2.bindPopup(popup2);


//api google




// function initialize() {
//   /* Instanciation du geocoder  */
//   geocoder = new google.maps.Geocoder();
//  
//  }
//function codeAddress() {
//   /* Récupération de la valeur de l'adresse saisie */
//   var address = "5 rue d'Etueffont 90170 anjoutey";
//   /* Appel au service de geocodage avec l'adresse en paramètre */
//   geocoder.geocode( { 'address': address}, function(results, status) {
//    /* Si l'adresse a pu être géolocalisée */
//    if (status == google.maps.GeocoderStatus.OK) {
//     /* Récupération de sa latitude et de sa longitude */
//    var lat = results[0].geometry.location.lat();
//    var lng = results[0].geometry.location.lng();
//     map.setCenter(results[0].geometry.location);
//    console.log(lat);
//    console.log(lng);
//    }
//       
//initialize();
//codeAddress();

//key= 'AIzaSyAsS_N7-o0yYGpzgLHM2Cu2nRyxktgGuRI';


