<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="locals.txt"></script> -->

    <title>Document</title>
</head>
<body>
<?php 

$db = mysqli_connect('localhost', 'root', '', 'registration');

$m = "SELECT * FROM `up` WHERE id = '1'";
$res_c = mysqli_query($db, $m);
$row = mysqli_fetch_array($res_c);
$Uid = $row['Uid'];

if($Uid == "1"){
header("Refresh:0");
echo($Uid);
$Uid = "0";
}

?>
<!-- <script>
var Uid = '<?php echo $Uid?>';
  setInterval(function() {

    if(Uid == "1"){
     location.reload();
   alert("Hi");
   var ab = 0;
   $.post('save.php', {abc: ab});
    }
    console.log(Uid);
  }, 90);
  clearInterval(setInterval);

</script> -->
</body>
</html>