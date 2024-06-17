<?php
include('includes/time.php');

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
$session_query = mysqli_query($con, "Select * from student");
while($session_array = mysqli_fetch_array($session_query)){
    if($_SESSION['stdid'] == $session_array['session_id']){
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
  } else{
    $stdid = $_SESSION['stdid'];
    $ret=mysqli_query($con,"select * from student  where session_id='$stdid'");
    $row=mysqli_fetch_array($ret);
    $reg=$row['RegNo'];

?>


<!doctype html>

 <html class="no-js" lang="">
<head>
<meta name="viewport" content="width=device-width, initial-scale=0.6, maximum-scale=2.0">
    <title>VPMS - Admin Dashboard</title>
   

    <link rel="apple-touch-icon" href="images/traffic-jam.png">
    <link rel="shortcut icon" href="images/traffic-jam.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="assets/css/fullcalendar.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/side-head.css">
    <link href = "assets/css/button.css" rel = "stylesheet"/>
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
                            <strong class="card-title">Vehicle Logs</strong>
                        </div>
                        <div class="card-body">
                             <table class="table">
                <thead>
                                        <tr>
                                            <tr>
                  <th>S.NO</th>
            
                 
                    <th>Category</th>
                    <th>Brand</th>
                    <th>License#</th>
                    <th>Status</th>
                    <th>Slot</th>
                    <th>TimeStamp</th>
                                        </thead>
               <?php
$ret1=mysqli_query($con,"select *from   stdvehstatus where RegNo='$reg' order by Timing DESC");             // Selecting vechile logs of the specific student in timing descending order (Recent on top)
$cnt=1;
    
while ($row1=mysqli_fetch_array($ret1)) {
                
            ?>
              
                <tr>
                  <td><?php echo $cnt;?></td>
            
                 
                  <td><?php  echo $row1['VehicleCategory'];?></td>
                  <td><?php  echo $row1['VehicleCompanyname'];?></td>
                  <td><?php  echo $row1['LicensePlateNo'];?></td>
                  <td><?php  echo $row1['VehicleStatus'];?></td>
                  <td><?php  echo $row1['ParkSlot'];?></td>
                  <td><?php  echo date('d-M-Y | h:i:s A', strtotime($row1['Timing']));?></td>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
              </table>

                    </div>
                </div>
            </div>

   

        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<div class="clearfix"></div>
   

    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/side-head.js"></script>

</body>
</html>
<?php } ?>