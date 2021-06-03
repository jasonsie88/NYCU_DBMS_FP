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
    $area=$_POST["area"];
    $where=$_POST["where"];
    $rating=$_POST["rating"];
    $day=$_POST["day"];
    $week=$_POST["week"];
    $parameter=0.0;
    if(rating==0.25){
      $parameter=0.66;
    }else if(rating==0.5){
      $parameter=0.33;
    }else if(rating==0.75){
      $paramter=-1.5;
    }else if(rating==1.0){
      $parameter=-5;
    }
    $weather_area;
    if($area=='Hsinchu'){
      $weather_area='新竹';
    }else if($area=='Taipei'){
      $weather_area='台北';
    }else if($area=='New Taipei'){
      $weather_area='新北';
    }else if($area=='Taoyuan'){
      $weather_area='桃園';
    }else if($area=='Taichung'){
      $weather_area='台中';
    }else if($area=='Tainan'){
      $weather_area='台南';
    }else if($area=='Kaohsiung'){
      $weather_area='高雄';
    }
    $weather_query="SELECT*
    FROM weather
    WHERE weather.time='$day' and weather.area='$weather_area' and weather.date='$week' ";
    $weather_p=mysqli_query($con,$weather_query);
    if($weather_p){
      while($obj=mysqli_fetch_object($weather_p)){
        echo"溫度: ";
        print($obj->temp);
        echo"<br></br>";
        echo"天氣狀況: ";
        print($obj->weather);
        echo"<br></br>-------------------<br></br>";                                                  
      }
      mysqli_free_result($weather_p);
    }else{
      echo"fail<br></br>";
    }
    if($where==outdoor){
      $sql_query = "SELECT outdoor_detail.name,outdoor_detail.address,outdoor_detail.phone,outdoor_detail.opening_hours,outdoor_rating.rating
      FROM outdoor_detail,outdoor_rating
      where  outdoor_detail.area='$area' and outdoor_detail.activity_id=outdoor_rating.activity_id 
      order by outdoor_rating.rating DESC";
      $avg_query = "SELECT avg(outdoor_rating.rating) as avg
      FROM outdoor_detail,outdoor_rating
      WHERE outdoor_detail.area='$area' and outdoor_detail.activity_id=outdoor_rating.activity_id";
      $std_query = "SELECT STD(outdoor_rating.rating) as std
      FROM outdoor_detail,outdoor_rating
      WHERE outdoor_detail.area='$area' and outdoor_detail.activity_id=outdoor_rating.activity_id";
      $avg_p=mysqli_query($con, $avg_query);
      $avg=0.0;
      if($avg_p){
         while($obj=mysqli_fetch_object($avg_p)){
           $avg=($obj->avg);
         }
         mysqli_free_result($avg_p);
      }else{
        echo"fail";
      }
      $std_p=mysqli_query($con, $std_query);
      $std=0.0;
      if($std_p){
        while($obj=mysqli_fetch_object($std_p)){
          $std=$obj->std;
        }
        mysqli_free_result($std_p);
     }else{
       echo"fail";
     }
    /* echo $std;
     echo"<br></br>";
     echo $avg;
     echo"<br></br>";*/
      $result=mysqli_query($con, $sql_query);
      if($result){
          while($obj = mysqli_fetch_object($result)){
            if($obj->rating>=($avg+$parameter*$std)){
              echo"評分 ";
              print($obj->rating);
              echo"<br></br>";
              echo"名稱: ";
              print ($obj->name);
              echo"<br></br>";
              echo"地址 ";
              print ($obj->address);
              echo"<br></br>";
              echo"聯絡電話 ";
              print ($obj->phone);
              echo"<br></br>";
              echo"營業時間 ";
              print ($obj->opening_hours);
              echo"<br></br>-------------------<br></br>";            
            }
           }
          mysqli_free_result($result);
      }
    }else if($where==indoor){
      $sql_query = "SELECT indoor_detail.name,indoor_detail.address,indoor_detail.phone,indoor_detail.opening_hours,indoor_rating.rating
      FROM indoor_detail,indoor_rating
      where  indoor_detail.area='$area' and indoor_detail.activity_id=indoor_rating.activity_id 
      order by indoor_rating.rating DESC";
      $avg_query = "SELECT avg(indoor_rating.rating) as avg
      FROM indoor_detail,indoor_rating
      WHERE indoor_detail.area='$area' and indoor_detail.activity_id=indoor_rating.activity_id";
      $std_query = "SELECT STD(indoor_rating.rating) as std
      FROM indoor_detail,indoor_rating
      WHERE indoor_detail.area='$area' and indoor_detail.activity_id=indoor_rating.activity_id";
      $avg_p=mysqli_query($con, $avg_query);
      $avg=0.0;
      if($avg_p){
      while($obj=mysqli_fetch_object($avg_p)){
          $avg=($obj->avg);
        }
        mysqli_free_result($avg_p);
      }else{
        echo"fail";
      }
      $std_p=mysqli_query($con, $std_query);
      $std=0.0;
      if($std_p){
        while($obj=mysqli_fetch_object($std_p)){
          $std=$obj->std;
        }
        mysqli_free_result($std_p);
        }else{
          echo"fail";
      }
     /* echo $std;
      echo"<br></br>";
      echo $avg;
      echo"<br></br>";*/
      $result=mysqli_query($con, $sql_query);
      if($result){
          while($obj = mysqli_fetch_object($result)){
            if($obj->rating>$avg+$parameter*$std){
              echo"評分 ";
              print($obj->rating);
              echo"<br></br>";
              echo"名稱: ";
              print ($obj->name);
              echo"<br></br>";
              echo"地址 ";
              print ($obj->address);
              echo"<br></br>";
              echo"聯絡電話 ";
              print ($obj->phone);
              echo"<br></br>";
              echo"營業時間 ";
              print ($obj->opening_hours);
              echo"<br></br>-------------------<br></br>";            
            }
           }
          mysqli_free_result($result);
      }     
    }

    mysqli_close($con);
?>