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
$weather_query="SELECT*
    FROM weather
    WHERE weather.time='$day' and weather.area='$weather_area' and weather.date='$week' ";
$delete_query="delete from indoor_detail where activity_id='$activity_id'";
$insert_query="insert into 
    indoor_detail(activity_id,name,area,address,phone,opening_hours) 
    values('$activity_id','$name','$area','$address','$phone','$opening_hours')";
$update_query="update indoor_detail
    set 
        name='$name',
        area='$area',
        address='$address',
        phone='$phone',
        opening_hours='$opening_hours'
    where
        activity_id='$activity_id'
        ";


