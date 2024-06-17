<?php
include('includes/time.php');
session_start();
include('includes/duration.php');

// Initialize $msg variable
$msg = "";

$time = $_SERVER['REQUEST_TIME'];

if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $session_timeout_duration) {
    header('location:logout.php');
    exit();
}

$_SESSION['LAST_ACTIVITY'] = $time;

include('includes/dbconnection.php');
$session_status = false;
$sidebar = false;
$session_query = mysqli_query($con, "SELECT * FROM student");
while ($session_array = mysqli_fetch_array($session_query)) {
    if ($_SESSION['stdid'] == $session_array['session_id']) {
        if ($session_array['session_id'] == NULL) {
            break;
        } else {
            $session_status = true;
            $sidebar = $session_array['sidebar'];
            break;
        }
    } else {
        $session_status = false;
    }
}
if ($session_status == false) {
    header('location:logout.php');
    exit();
} else {
    $studentid = $_SESSION['stdid'];
    $ret = mysqli_query($con, "SELECT * FROM student WHERE session_id='$studentid'");
    $row = mysqli_fetch_array($ret);
    $reg = $row['RegNo'];
    $fname = $row['FirstName'];
    $lname = $row['LastName'];

    if (isset($_POST['submit'])) {
        $catename = $_POST['catename'];
        $vehcomp = $_POST['brand'] . " " . $_POST['model'];
        $vehreno1 = strtoupper($_POST['vehreno1']);
        $vehreno2 = $_POST['vehreno2'];
        $query = mysqli_query($con, "INSERT INTO stdvehicle(RegNo, FirstName, LastName, VehicleCategory, VehicleCompanyname, LicensePlateNo) VALUES ('$reg', '$fname', '$lname', '$catename', '$vehcomp', '$vehreno1-$vehreno2')");
        if ($query) {
            echo "<script>alert('Vehicle Entry Detail has been added');</script>";
            echo "<script>window.location.href ='dashboard.php'</script>";
        } else {
            echo "<script>alert('Something Went Wrong. Please try again.');</script>";
        }
    }
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=0.9, maximum-scale=2.0">
    <title>VPMS - Add Vehicle</title>

    <link rel="apple-touch-icon" href="images/traffic-jam.png">
    <link rel="shortcut icon" href="images/traffic-jam.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/side-head.css">
    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="assets/css/fullcalendar.min.css" rel="stylesheet" />
    <link href="assets/css/button.css" rel="stylesheet"/>
</head>
<body>

<?php include_once('includes/std-sidebarnew.php');?>

<div id="content" class="p-4 p-md-5">
    <?php include_once('includes/std-headernew.php');?>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6">
                <div class="card"></div> <!-- .card -->
            </div><!--/.col-->

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Add </strong> Vehicle
                    </div>
                    <div class="card-body card-block">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <p style="font-size:16px; color:red" align="center"> 
                                <?php if ($msg) {
                                    echo $msg;
                                } ?> 
                            </p>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="select" class=" form-control-label">Category</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select onchange="fetch_brand(this.value);" name="catename" id="catename" class="form-control">
                                        <option disabled="disabled" selected="selected">Select Category</option>
                                        <?php 
                                            $query = mysqli_query($con, "SELECT * FROM stdcategory");
                                            while ($row1 = mysqli_fetch_array($query)) { 
                                        ?>    
                                            <option value="<?php echo $row1['VehicleCat']; ?>"><?php echo $row1['VehicleCat']; ?></option>
                                        <?php } ?> 
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Brand</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select onchange="fetch_model(this.value);" name="brand" id="brand" class="form-control">
                                        <option disabled="disabled" selected="selected">Select Brand</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Model</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select id="model" name="model" class="form-control">
                                        <option disabled="disabled" selected="selected">Select Model</option>
                                    </select>           
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">License Plate #</label>
                                </div>
                                <div class="col-12 col-md-2">
                                    <input type="text" minlength="3" maxlength="3" id="vehreno1" name="vehreno1" class="form-control" required="true" placeholder="Example: LEN">
                                </div>
                                <div class="col-12 col-md-2">
                                    <input type="tel" id="vehreno2" name="vehreno2" class="form-control" required="true" maxlength="4" placeholder="Example: 2941">
                                </div>
                            </div>
                            <p style="text-align: center;">
                                <button type="submit" class="btn btn-primary btn-sm" name="submit">Add</button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6"></div>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<!-- Scripts -->
<script>
function fetch_brand(val) {
    jQuery.ajax({
        type: 'post',
        url: 'fetch_brand.php',
        data: {
            get_option: val
        },
        success: function (response) {
            document.getElementById("brand").innerHTML = "<option disabled='disabled' selected='selected'>Select Brand</option>";
            document.getElementById("brand").innerHTML += response; 
            document.getElementById("model").innerHTML += "<option disabled='disabled' selected='selected'>Select Model</option>";
        }
    });
}

function fetch_model(val) {
    jQuery.ajax({
        type: 'post',
        url: 'fetch_model.php',
        data: {
            get_option: val,
            get_cat: document.getElementById("catename").value
        },
        success: function (response) {
            document.getElementById("model").innerHTML = response; 
        }
    });
}
</script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/side-head.js"></script>

</body>
</html>
<?php } ?>
