<!-- <script type="text/javascript" src="js/jquery-1.4.2.js"></script>
    <script type="text/javascript" src="js/speedometer.js"></script>
    
        <div id = "speed" ></div> -->

<?php 
if(isset($_POST['displaySpeed']))
     {
        //$connection = mysql_connect("localhost", "root", "");
        //$db = mysql_select_db("Speed", $connection);

        //convert time in seconds
        $t=date("G");
        $t2=date("i");
        $se=$t*3600 + $t2*60;

        $d1 = $_POST['displaySpeed'];
        for($i=1;$i<2;$i++){
            $o= $i/120;
        $dis=$d1*$o;
        //$spd = $_POST['$d1'];
        //$message = "$d1";
        //echo "<script type='text/javascript'>alert('$message');</script>";
       //$json = json_encode($d1);
       //file_put_contents('your_data.txt', $d1);
       $file = fopen("Logs\Speed.txt","a+");
       $s = round($d1,1,PHP_ROUND_HALF_UP).","."\r\n";
       fputs($file,$s);
       fclose($file);

       //time
       $file = fopen("Logs\Time.txt","a+");
       $s = date("G:i a").",".$se."\r\n";
       fputs($file,$s);
       fclose($file);

       //avg
       $file = fopen("Logs\Dis.txt","a+");
       $m =  round($m + $dis,1,PHP_ROUND_HALF_UP).","."\r\n";
       fputs($file,$m);
       fclose($file);
        }
    }
        
?>