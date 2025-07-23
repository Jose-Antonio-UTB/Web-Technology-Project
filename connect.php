<?php

    $host="localhost";
    $user="root";
    $pass="";
    $db="warframemerchdb";

    $conn=new mysqli($host,$user,$pass,$db);
    if($conn->connect_error){
        echo "Failed to Connect.".$conn->connect_error;
    }
?>