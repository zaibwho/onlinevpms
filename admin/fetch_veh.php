<?php
date_default_timezone_set('Asia/Karachi');

if(isset($_POST['get_option']))
{
    include('includes/dbconnection.php');

 $cat = $_POST['get_cat'];
 $brand = $_POST['get_option'];
 $find=mysqli_query($con,"select model from veh_info where brand='$brand' and cat='$cat'");
 while($row=mysqli_fetch_array($find))
 {
  echo "<option>".$row['model']."</option>";
 }
 exit;
}
?>