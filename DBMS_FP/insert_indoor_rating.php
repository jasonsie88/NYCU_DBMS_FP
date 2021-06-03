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
    $rating=$_POST["rating"];
    $insert_query="insert into 
    indoor_rating(activity_id,rating)
    values('$activity_id','$rating')";
    $insert_p=mysqli_query($con,$insert_query);
    if($insert_p){ 
        mysqli_free_result($insert_p);
        $check_query="select*
        from indoor_rating
        where activity_id='$activity_id'";
        $check_p=mysqli_query($con,$check_query);
        while($obj=mysqli_fetch_object($check_p)){
            echo"id: ";
            print($obj->activity_id);
            echo"<br></br>";
            echo"rating: ";
            print($obj->rating);
            echo"<br></br>-------------------<br></br>";                                                  
        }
        mysqli_free_result($check_p);
    }else{
      echo"fail<br></br>";
    }
    mysqli_close($con);
?>