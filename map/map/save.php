<?php 
if(isset($_POST['latitude']))
     {
         $d1 = $_POST['latitude'];
         $d11 = $_POST['longitude'];
         $default10 = "let t1 = ";
         $default11 = "let t2 = ";
         //$d2 = $_POST['lat'];
       
       $file = fopen("currentlat.txt","w");
       $s = ($default10)."'".($d1)."'". "\r\n";
       fputs($file,$s);
       fclose($file);

       $file = fopen("currentlong.txt","w");
       $s = ($default11)."'".($d11)."'"."\r\n";
       fputs($file,$s);
       fclose($file);

    //    //time
    //    $file = fopen("Logs\Time.txt","a+");
    //    $s = date("G:i a").",".$se."\r\n";
    //    fputs($file,$s);
    //    fclose($file);

    //    //avg
    //    $file = fopen("Logs\Dis.txt","a+");
    //    $m =  round($m + $dis,1,PHP_ROUND_HALF_UP).","."\r\n";
    //    fputs($file,$m);
    //    fclose($file);
    //     }
    }
    if(isset($_POST['lat']))
    {
        $d2 = $_POST['lat'];
        $d22 = $_POST['lng'];
        $default20 = "let t3 = ";
        $default21 = "let t4 = ";
       
       $file = fopen("destlat.txt","w");
       $s = ($default20)."'".($d2)."'". "\r\n";
       fputs($file,$s);
       fclose($file);

       $file = fopen("destlong.txt","w");
       $s = ($default21)."'".($d22)."'". "\r\n";
       fputs($file,$s);
       fclose($file);


    }
?>