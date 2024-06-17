<?php
date_default_timezone_set('Asia/Karachi');

include('includes/dbconnection.php');
include('../path.php');
session_start();
$old_session = $_SESSION['stdaid'];
$logout_query = mysqli_query($con, "UPDATE stdadmin SET session_id = NULL WHERE session_id = '$old_session' ");
if($logout_query){
session_unset();
session_destroy();
header('Location: ' . $path . '/');
}
else {
    echo("logout Query failed");
}

?>