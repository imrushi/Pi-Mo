<?php 
include('../index.html');
$i = session_id();
echo $i;
// variable declaration
$d1 = "";
$d11 = "";
$e1 = "";
$e11 = "";

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'registration');

if(isset($_POST['lat']))
     {
         $i = session_id();
         $e1 = $_POST['lat'];
         $e11 = $_POST['lng'];

            $query = "INSERT INTO `track` (`id`, `lat`, `lng`) VALUES ('$i', '$e1', '$e11');";   
            mysqli_query($db, $query);
            $q = "UPDATE `track` SET `lat` = '$e1', `lng` = '$e11' WHERE `track`.`id` = $i;";
            mysqli_query($db, $q);
     }
?>