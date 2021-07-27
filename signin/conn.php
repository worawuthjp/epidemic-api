<?php 
        
    $connect = new mysqli("localhost","root","","db_covid");    

    if ($connect) {
    }else{
        echo "Connection Failed";
        exit();
    }
?>