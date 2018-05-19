$(document).ready(function() {
    document.getElementById("#mapButton");   
     var daddr = window.location.search.slice(1);
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(data){
        if (data.coords) {
          window.location = 'https://www.google.co.in/maps?saddr=' + data.coords.latitude + ',' + data.coords.longitude + '&daddr=' + daddr;
        }
      });
    }
});							

  