<?php 

$db = mysqli_connect('localhost', 'root', '', 'registration');

 if(isset($_POST['abc'])){

    $d1 = $_POST['abc'];
    $query = "INSERT INTO `up` (`id`, `Uid`) VALUES ('1', '$d1');";   
    mysqli_query($db, $query);
    $q = "UPDATE `up` SET `Uid` = '$d1' WHERE `up`.`id` = '1';";
    mysqli_query($db, $q);
    // $default10 = "let update = ";

    // $file = fopen("locals.txt","w");
    // $s = ($default10)."'".($d1)."'". "\r\n";
    // fputs($file,$s);
    // fclose($file);
 }

?>