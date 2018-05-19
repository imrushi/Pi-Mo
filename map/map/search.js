// import lat from './map';
// console.log(lat);
var marker = new google.maps.Marker({
  position:{
    lat:19.99133674820168 , 
    lng:73.7896728515625
  },
  map:map,
  draggable: true
});

var searchBox = new google.maps.places.SearchBox(document.getElementById('mapsearch'));
//place change event on search box
google.maps.event.addListener(searchBox, 'places_changed', function(){
  //console.log(sBox.getPlaces());
  var places = searchBox.getPlaces();

  //bound
  var bounds = new google.maps.LatLngBounds();
  var i,place;

  for(i=0; place=places[i]; i++){

    //console.log(place.geometry.location);

    bounds.extend(place.geometry.location);
    marker.setPosition(place.geometry.location);//set marker position new
    markerLocation();
  }
  map.fitBounds(bounds);//fit to the bound
  map.setZoom(15);
});

google.maps.event.addListener(map, 'click', function(event) {                
    //Get the location that the user clicked.
    var clickedLocation = event.latLng;
    //If the marker hasn't been added.
    if(marker === false){
        //Create the marker.
        marker = new google.maps.Marker({
            position: clickedLocation,
            map: map,
            draggable: true //make it draggable
        });
        //Listen for drag events!
        google.maps.event.addListener(marker, 'dragend', function(event){
            markerLocation();
        });
    } else{
        //Marker has already been added, so just change its location.
        marker.setPosition(clickedLocation);
    }
    //Get the marker's location.
    markerLocation();
});

function markerLocation(){
//Get location.
var currentLocation = marker.getPosition();
//Add lat and lng values to a field that we can save.
// document.getElementById('lat').value = currentLocation.lat(); //latitude
// document.getElementById('lng').value = currentLocation.lng(); //longitude
console.log("Latitude :",currentLocation.lat()," Longtitude :",currentLocation.lng());
}