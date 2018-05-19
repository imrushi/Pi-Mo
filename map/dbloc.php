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

if(isset($_POST['latitude']))
     {
         $i = session_id();
         $e1 = $_POST['latitude'];
         $e11 = $_POST['longitude'];

            $query = "INSERT INTO `curr` (`id`, `currLat`, `currLong`) VALUES ('$i', '$e1', '$e11');";   
            mysqli_query($db, $query);
            $q = "UPDATE `curr` SET `currLat` = '$e1', `currLong` = '$e11' WHERE `curr`.`id` = $i;";
            mysqli_query($db, $q);
     }

if(isset($_POST['lat']))
     {
         $i = session_id();
         $d1 = $_POST['lat'];
         $d11 = $_POST['lng'];
         
            $query = "INSERT INTO `dest` (`id`, `destLat`, `destLong`) VALUES ('$i', '$d1', '$d11');";           
            mysqli_query($db, $query);
            $qq = "UPDATE `dest` SET `destLat` = '$d1', `destLong` = '$d11' WHERE `dest`.`id` = $i;";
            mysqli_query($db, $qq);
     }
?>