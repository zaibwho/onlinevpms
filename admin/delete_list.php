<?php
date_default_timezone_set('Asia/Karachi');

session_start();
include('includes/duration.php');

//Read the request time of the user
$time = $_SERVER['REQUEST_TIME'];
//Check the user's session exist or not

if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $session_timeout_duration) {

    header('location:logout.php');
}

$_SESSION['LAST_ACTIVITY'] = $time;
 
include('includes/dbconnection.php');
 
$session_status = false;
$session_query = mysqli_query($con, "Select * from stdadmin");
while($session_array = mysqli_fetch_array($session_query)){
    if($_SESSION['stdaid'] == $session_array['session_id']){
      if( $session_array['session_id'] == NULL){
        break;
      }
      else{
          $session_status = true;
          break;
      }
    }
    else{
        $session_status = false;
    }
}
if ($session_status == false) {
  header('location:logout.php');
}
  else{
    $del_id = $_GET['del'];
    $del_query = mysqli_query($con, "delete from veh_info  where session_id='$del_id'");
    if($del_query){
     echo "<script>
        alert('Row Deleted');
        location.href = 'veh_list.php';
        </script>";
    }
    else {
        echo "<script>
        alert('Error while deleting row');
        location.href = 'veh_list.php';
        </script>"; 
    }
  }

?>