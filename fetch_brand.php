<?php
include('includes/time.php');

if(isset($_POST['get_option']))
{
    include('includes/dbconnection.php');

 $cat = $_POST['get_option'];
 $find=mysqli_query($con,"select distinct brand from veh_info where cat='$cat'");
 while($row=mysqli_fetch_array($find))
 {
  echo "<option>".$row['brand']."</option>";
 }
 exit;
}
?>