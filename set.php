<?php 
    session_start(); 
    if (isset($_SESSION['id'])){
        $m = $_SESSION['id'];
    session_id($m);
    }

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
        header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="assets/css/main.css" />
<link rel="icon" type="image/png" href="/Logo.png">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
div.container {
    width: 100%;
    border: 1px solid gray;
}

header, footer {
    padding: 1em;
    color: white;
    background-color: #723a806b;
    clear: left;
    text-align: center;
    border: 2px ;
    border-radius: 8px;
}

nav {
    float: left;
    max-width: 160px;
    margin: 0;
    padding: 1em;
}

nav ul {
    list-style-type: none;
    padding: 0;
}
   
nav ul a {
    text-decoration: none;
}

article {
    /* margin-left: 230px; */
    border-left: 1px solid gray;
    padding: 1em;
    overflow: hidden;
}
b {
    
    font-size: 20px;
    color:#ffffff;
}
</style>
</head>
<body>
<style>
.button {
    background-color: #555555; 
    border: none;
    color: white;
    padding: 0px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 11px;
    margin: 2px 1px;
    cursor: pointer;
}

.button1 {border-radius: 2px;}
.button2 {border-radius: 4px;}
.button3 {border-radius: 8px;}
.button4 {border-radius: 12px;}
.button5 {border-radius: 50%;}
.button6 {visibility: hidden;     font-size: 0px;}

#bb {
    visibility: hidden;
}
#drop {
    width: 100%;
    /* padding: 50px 0; */
    padding-top: 0px;
    padding-bottom: 20px;
    text-align: center;
    /* background-color: lightblue; */
    margin-top: 20px;
}
#map-canvas{
            width: 400px; 
            height: 300px;
        }

#content {
    width: 100%;
    /* padding: 50px 0; */
    padding-top: 0px;
    padding-bottom: 10px;
    text-align: left;
    /* background-color: lightblue; */
    margin-top: 20px;
    display:none;
}
</style>

<button class="button button5" onclick="goBack()">Back</button>
		<script>
				function goBack() {
					window.history.back();
				}
                </script>
<div class="header">
	</div>
	<div class="content">
	<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						// echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

<div class="container">

<header>
   <h1>Settings</h1>
</header>
  
<nav>
  <ul>
    <li><h3>Welcome</h3></li>
    <li><h3>User</h3></li>
  </ul>
</nav>

<article>
<?php  if (isset($_SESSION['username'])) : ?>
            <p><b>UserName:</b> <strong><?php echo $_SESSION['username']; ?></strong></p>
            <p><b>Vehicle Name:</b> <?php echo $_SESSION['VehName']; ?></p>
            <!-- <p><b>Distance Traveled: </b></p> -->
            <div class="input-group">
            <p><button onclick="location.href= 'about.php'">About</button>
            <p><button onclick="location.href= 'usrdoc.php'">User Documentation</button>
            <p><button id="toggle">Track vehicle</button>
            <div id="content">
            <?php 
            // connect to database
            $i = session_id();
            $db = mysqli_connect('localhost', 'root', '', 'registration');

            $sql_u = "SELECT * FROM track WHERE id='$i'";
            $res_c = mysqli_query($db, $sql_u);
            $row = mysqli_fetch_array($res_c);
            $Lat = $row['lat'];
            $Long = $row['lng'];
          
            ?>

                <!-- <input id="mapsearch" value=<?php echo $Lat,",",$Long ?>> -->
                <button class="button button6" id="mapsearch" onclick="re()"></button>

                <div id="map-canvas" style="height: 300px"></div>
                <?php echo "Latitude: ".$Lat;?>
                <?php echo "Longtitude: ".$Long;?>

            </div>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvoOi4HzZMJje9kRO1luDPsold3SlBTjo&libraries=places"></script>
			<p><button> <a onclick="logout()" style="color: red;">Logout</a></button> </p>
		<?php endif ?>
</article>
<script>
					function logout(){
						var r= confirm("Do you want to logout");
						if(r==true){
							window.location.assign("index.php?logout='1'");
						}
					}
                    </script>
                    
                    <script>
                        var toggle  = document.getElementById("toggle");
                        var content = document.getElementById("content");

                        toggle.addEventListener("click", function(){
                        content.style.display = (content.dataset.toggled ^= 1) ? "block" : "none";
                        }, false);

function dp() {
    var x = document.getElementById("drop");
    x.style.display = "none";
    if (x.style.display === "none" || x.style.display === '') {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>

    <script type="text/javascript">
    

// function initialize() {
//   var input = document.getElementById('mapsearch');
//   new google.maps.places.Autocomplete(input);
// }

// document.getElementById("demo").innerHTML = "Latitude:",;
// document.getElementById("demo1").innerHTML = "Longtitude:",;

    var map = new google.maps.Map(document.getElementById('map-canvas'),{
  center:{
    lat: <?php echo $Lat ?>,
    lng:<?php echo $Long ?>
  },
  gestureHandling: 'greedy',
  zoom:15
});

        var icons = {
          moped: {
            icon: 'mapmarker.png'
          },
        };

var marker = new google.maps.Marker({
      position:{
        lat:<?php echo $Lat ?> , 
        lng:<?php echo $Long ?>
      },
      map:map,
      draggable: false
 });
 
 google.maps.event.trigger(map, 'resize');


 var searchBox = new google.maps.places.SearchBox(document.getElementById('mapsearch'));

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

function markerLocation(){
    //Get location.
    var currentLocation = marker.getPosition();
    //Add lat and lng values to a field that we can save.
    // document.getElementById('lat').value = currentLocation.lat(); //latitude
    // document.getElementById('lng').value = currentLocation.lng(); //longitude
    var lat = currentLocation.lat();
    var lng = currentLocation.lng();
   
    console.log("Latitude :",currentLocation.lat()," Longtitude :",currentLocation.lng());
}

function re(){

    var latlng = new google.maps.LatLng(<?php echo $Lat.", ".$Long?>);
    marker.setPosition(latlng);
    markerLocation();
}

</script>
<script>
        $(document).ready(function() {
          setInterval(function() {
            <?php 
            // connect to database
            $i = session_id();
            $db = mysqli_connect('localhost', 'root', '', 'registration');

            $sql_u = "SELECT * FROM track WHERE id='$i'";
            $res_c = mysqli_query($db, $sql_u);
            $row = mysqli_fetch_array($res_c);
            $Lat = $row['lat'];
            $Long = $row['lng'];
          
            ?>
            $("#mapsearch").trigger('click');
          }, 1000);
        });

        </script>
<footer>PIMO</footer>

</div>

</body>
</html>