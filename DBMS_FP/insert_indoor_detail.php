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
    $activity_id=$_POST["activity_id"];
    $name=$_POST["name"];
    $area=$_POST["area"];
    $address=$_POST["address"];
    $phone=$_POST["phone"];
    $opening_hours=$_POST["opening_hours"];
    $insert_query="insert into 
    indoor_detail(activity_id,name,area,address,phone,opening_hours) 
    values('$activity_id','$name','$area','$address','$phone','$opening_hours')";
    $insert_p=mysqli_query($con,$insert_query);
    if($insert_p){ 
        mysqli_free_result($insert_p);
        $check_query="select*
        from indoor_detail
        where activity_id='$activity_id'";
        $check_p=mysqli_query($con,$check_query);
        while($obj=mysqli_fetch_object($check_p)){
            echo"id: ";
            print($obj->activity_id);
            echo"<br></br>";
            echo"name: ";
            print($obj->name);
            echo"<br></br>";
            echo"area: ";
            print($obj->area);
            echo"<br></br>";
            echo"address: ";
            print($obj->address);
            echo"<br></br>";
            echo"phone: ";
            print($obj->phone);
            echo"<br></br>";
            echo"area: ";
            print($obj->opening_hours);
            echo"<br></br>-------------------<br></br>";                                                  
        }
        mysqli_free_result($check_p);
    }else{
      echo"fail<br></br>";
    }
    mysqli_close($con);
?>