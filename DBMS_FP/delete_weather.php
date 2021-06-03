<?php
    $user = 'root';
    $password = 'root';
    $db = 'fp';
    $host = 'localhost';
    $port = 8889;
    $con = mysqli_connect($host, $user, $password, $db, $port);
    if (mysqli_connect_errno($con)) { 
        echo "連接 MySQL 失敗: " . mysqli_connect_error(); 
    } 
    $weather_id=$_POST["weather_id"];
    $delete_query="delete from weather where weather_id='$weather_id'";
    $delete_p=mysqli_query($con,$delete_query);
    if($delete_p){ 
        mysqli_free_result($delete_p);
        echo"Success!!";
    }else{
      echo"fail<br></br>";
    }
    mysqli_close($con);
?>