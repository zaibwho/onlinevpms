<?php
$stdid = $_POST['get_option'];
include('dbconnection.php');
$chk_query = mysqli_query($con, "SELECT * FROM student  where session_id = '$stdid'");
$chk_array = mysqli_fetch_array($chk_query);
$sidebar = $chk_array['sidebar'];
 if($sidebar == 0){
  $sidebar_query = mysqli_query($con, "UPDATE student SET sidebar = true  where session_id = '$stdid' ");
  if(!$sidebar_query){echo "sidebar updation failed 1";}
 }
 else{
  $sidebar_query = mysqli_query($con, "UPDATE student SET sidebar = false  where session_id = '$stdid' ");
  if(!$sidebar_query){echo "sidebar updation failed 2";}
 }
?>