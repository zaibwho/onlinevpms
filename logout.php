<?php
include('includes/time.php');
include('includes/dbconnection.php');
include('path.php');
session_start();

$old_session = $_SESSION['stdid'];
$logout_query = mysqli_query($con, "UPDATE student SET session_id = NULL WHERE session_id = '$old_session'");

if ($logout_query) {
    session_unset();
    session_destroy();

    header('Location: ' . $path . '/');
    exit();
} else {
    echo("Logout query failed");
}
?>
