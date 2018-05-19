<?php 

$db = mysqli_connect('localhost', 'root', '', 'registration');

$m = "SELECT * FROM `up` WHERE id = '1'";
$res_c = mysqli_query($db, $m);
$row = mysqli_fetch_array($res_c);
$Uid = $row['Uid'];
?>

<script type="text/javascript">
var Uid = '<?php echo $Uid?>';
</script>