<?php
include('includes/time.php');               // time variable in the php File

session_start();

include('includes/duration.php');           // Session Timeout Variable

//Read the request time of the user
$time = $_SERVER['REQUEST_TIME'];

//Check if the user's session exists and is valid
if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $session_timeout_duration) {
    header('location:logout.php');
    exit();
}

$_SESSION['LAST_ACTIVITY'] = $time;

include('includes/dbconnection.php');       // Database Connection

$session_status = false;

if (isset($_SESSION['stdid'])) {
    $stdid = $_SESSION['stdid'];
    $session_query = mysqli_query($con, "SELECT * FROM student WHERE session_id = '$stdid'");
    $session_array = mysqli_fetch_array($session_query);

    if ($session_array) {
        if ($session_array['session_id'] != NULL) {
            $session_status = true;
        }
    }
}

if (!$session_status) {
    header('location:logout.php');
    exit();
}

$ret = mysqli_query($con, "SELECT * FROM student WHERE session_id='$stdid'");
$row = mysqli_fetch_array($ret);
$reg = $row['RegNo'];

if (isset($_POST['OUT'])) {
    $fname = $row['FirstName'];
    $lname = $row['LastName'];
    $vehcatout = $_POST['Vcat'];
    $vehcompout = $_POST['Vname'];
    $vehrenoout = $_POST['Vnum'];
    $slot = $_POST['Parkslot'];
    $current_timestamp = date("Y-m-d H:i:s"); // Assuming you have a variable for current timestamp

    $queryout = mysqli_query($con, "INSERT INTO stdvehstatus (RegNo, FirstName, LastName, VehicleCategory, VehicleCompanyname, LicensePlateNo, VehicleStatus, ParkSlot, Timing) VALUES ('$reg', '$fname', '$lname', '$vehcatout', '$vehcompout', '$vehrenoout', 'OUT', '$slot', '$current_timestamp')");
    
    $out = $_POST['ID'];
    $queryoutupdate = mysqli_query($con, "UPDATE stdvehicle SET Status = 'OUT', ParkSlot = NULL  where ID = '$out'");
    $queryslotupdate = mysqli_query($con, "UPDATE parkingslot SET State = false WHERE Slot = '$slot'");

    if ($queryout && $queryoutupdate && $queryslotupdate) {
        echo "<script>
                  alert('Vehicle is out of the parking');
                  location.href = 'dashboard.php';
              </script>";
    } else {
        echo "<script>alert('Something Went Wrong. Please try again.');</script>";       
    }
}
?>

<!doctype html>
<html class="no-js" lang="">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=0.6, maximum-scale=2.0">
    <title>VPMS - Student Dashboard</title>
    <link rel="apple-touch-icon" href="images/traffic-jam.png">
    <link rel="shortcut icon" href="images/traffic-jam.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="assets/css/fullcalendar.min.css" rel="stylesheet" />
    <link href="assets/css/side-head.css" rel="stylesheet"/>
    <link href="assets/css/button.css" rel="stylesheet"/>
</head>

<body>
    <?php include_once('includes/std-sidebarnew.php');?>

    <div id="content" class="p-4 p-md-5">
        <?php include_once('includes/std-headernew.php');?>
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Vehicle List</strong>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>License #</th>
                                    <th>Slot</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret1 = mysqli_query($con, "SELECT * FROM stdvehicle WHERE RegNo='$reg'");
                                    while ($row1 = mysqli_fetch_array($ret1)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row1['VehicleCategory']; ?></td>
                                        <td><?php echo $row1['VehicleCompanyname']; ?></td>
                                        <td><?php echo $row1['LicensePlateNo']; ?></td>
                                        <td><?php echo $row1['ParkSlot'] != NULL ? $row1['ParkSlot'] : "N/A"; ?></td>
                                        <td>
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <input style="display:none" name="ID" type="number" value="<?php echo $row1['ID']; ?>">
                                                <input style="display:none" name="Vcat" type="text" value="<?php echo $row1['VehicleCategory']; ?>">
                                                <input style="display:none" name="Vname" type="text" value="<?php echo $row1['VehicleCompanyname']; ?>">
                                                <input style="display:none" name="Vnum" type="text" value="<?php echo $row1['LicensePlateNo']; ?>">
                                                <input style="display:none" name="Parkslot" type="number" value="<?php echo $row1['ParkSlot']; ?>">
                                                <a role="link" <?php if($row1['Status'] != 'IN'){ ?>href="gmap.php?parkingid=<?php echo $row1['ID']; ?>" class="green btn"<?php } else { ?>class="disabled btn"<?php } ?>>IN</a>
                                                <button class="red btn" name="OUT" <?php if($row1['Status'] == 'OUT'){ ?> disabled<?php } ?>>OUT</button>  
                                            </form>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="clearfix"></div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/side-head.js"></script>
</body>
</html>
