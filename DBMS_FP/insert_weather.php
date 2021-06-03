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
    $time=$_POST["time"];
    $area=$_POST["area"];
    $date=$_POST["date"];
    $temp=$_POST["temp"];
    $weather=$_POST["weather"];
    $insert_query="insert into 
    weather(weather_id,area,time,date,temp,weather) 
    values('$weather_id','$area','$time','$date','$temp','$weather')";
    $insert_p=mysqli_query($con,$insert_query);
    if($insert_p){ 
        mysqli_free_result($insert_p);
        $check_query="select*
        from weather
        where weather_id='$weather_id'";
        $check_p=mysqli_query($con,$check_query);
        while($obj=mysqli_fetch_object($check_p)){
            echo"id: ";
            print($obj->weather_id);
            echo"<br></br>";
            echo"area: ";
            print($obj->area);
            echo"<br></br>";
            echo"time: ";
            print($obj->time);
            echo"<br></br>";  
            echo"date: ";
            print($obj->date);
            echo"<br></br>";  
            echo"temp: ";
            print($obj->temp);
            echo"<br></br>"; 
            echo"weather: ";
            print($obj->weather);
            echo"<br></br>-------------------<br></br>";                                                  
        }
        mysqli_free_result($check_p);
    }else{
      echo"fail<br></br>";
    }
    mysqli_close($con);
?>