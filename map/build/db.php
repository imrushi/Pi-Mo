<?php 

session_start();
if (isset($_SESSION['id'])){
	$m = $_SESSION['id'];
session_id($m);
}
echo session_id();
// variable declaration

$i = session_id();
$d1 = "";
$d11 = "";
$e1 = "";
$e11 = "";

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'registration');


            $sql_u = "SELECT * FROM curr WHERE id='$i'";
            $res_c = mysqli_query($db, $sql_u);
            $row = mysqli_fetch_array($res_c);
            $currLat = $row['currLat'];
            $currLong = $row['currLong'];
        
            $q = "SELECT * FROM `dest` WHERE id = '$i'";           
            $res_d = mysqli_query($db, $q);
            $row = mysqli_fetch_array($res_d);
            $destLat = $row['destLat'];
            $destLong = $row['destLong'];

?>

<script type="text/javascript">
var currLat = '<?php echo $currLat?>';
var currLong = '<?php echo $currLong?>';
var destLat = '<?php echo $destLat?>';
var destLong = '<?php echo $destLong?>';
</script>