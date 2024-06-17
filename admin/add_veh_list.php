<?php
date_default_timezone_set('Asia/Karachi');

session_start();
include('includes/duration.php');

$msg = '';
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
  } else{
    if(isset($_POST['submit']))
  {
    $cat = $_POST['catename'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $length = $_POST['length'];
    $width = $_POST['width'];
    $query=mysqli_query($con, "insert into veh_info(cat,brand,model,length,width) values('$cat','$brand','$model','$length','$width')");
    if ($query) {
    $msg="Vehicle Information is added.";
  }
  else
    {
      $msg="Something Went Wrong. Please try again.";
    }
}
  ?>
<!doctype html>
<html class="no-js" lang="">
<head>
<meta name="viewport" content="width=device-width, initial-scale=0.9, maximum-scale=2.0">
    <title>VPMS - Add Vehicle Info</title>
   
    
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
    <link href = "assets/css/button.css" rel = "stylesheet"/>
    
    
</head>
<body>
<?php include_once('includes/sidebarnew.php');?>

<div id="content" class="p-4 p-md-5">
<?php include_once('includes/headernew.php');?>


            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            
                           
                        </div> <!-- .card -->

                    </div><!--/.col-->

              

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Add </strong> Vehicle information
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
                                     <div class="row form-group">
                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Category</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="catename" id="catename" class="form-control">
                                                <option disabled = "disabled" selected = "selected">Select Category</option>
                                                <?php $query=mysqli_query($con,"select * from stdcategory");
              while($row=mysqli_fetch_array($query))
              {
              ?>                                
                                                 <option value="<?php echo $row['VehicleCat'];?>"><?php echo $row['VehicleCat'];?></option>
                                                 
                  <?php } ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <!-- brand Name -->
                                    <div class="row form-group">
                                        <div class = "col col-md-3"><label for="brand" class = " form-control-label">Brand Name</label></div>
                                        <div class = "col-12 col-md-9">
                                        <input class=" form-control" id="brand" name="brand" type="text" required = "true">
                                        </div>
                                    </div>
                                    <!-- model name -->
                                    <div class="row form-group">
                                        <div class = "col col-md-3"><label for="model" class = " form-control-label">Model Name</label></div>
                                        <div class = "col-12 col-md-9">
                                        <input class=" form-control" id="model" name="model" type="text" required = "true">
                                        </div>
                                    </div>
                                    <!-- length -->
                                    <div class="row form-group">
                                        <div class = "col col-md-3"><label for="length" class = " form-control-label">Length</label></div>
                                        <div class = "col-12 col-md-9">
                                        <input class=" form-control" id="length" name="length" type="number" required = "true">
                                        </div>
                                    </div>

                                    <!-- width -->
                                    <div class="row form-group">
                                        <div class = "col col-md-3"><label for="width" class = " form-control-label">Width</label></div>
                                        <div class = "col-12 col-md-9">
                                        <input class=" form-control" id="width" name="width" type="number" required = "true">
                                        </div>
                                    </div>
                                   <p style="text-align: center;"> <button type="submit" class="btn btn-primary btn-sm" name="submit" >Add</button></p>
                                </form>
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="col-lg-6">
                        
                  
                </div>

           

            </div>


        </div><!-- .animated -->
       
    </div><!-- .content -->
   
    <div class="clearfix"></div>

 

</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/side-head.js"></script>
</body>
</html>
<?php }  ?>