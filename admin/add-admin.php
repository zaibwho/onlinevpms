<?php
include('includes/time.php');

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
    
    $aname = $_POST['adminname'];
    $contact1 = $_POST['contact1'];
    $contact2 = $_POST['contact2'];
    $user = $_POST['username'];
    $pass = md5($_POST['password']);
    $cn_pass = md5($_POST['confirmpass']);
    $email = $_POST['email'];

    if($cn_pass == $pass){

  
     $query=mysqli_query($con, "insert into stdadmin(AdminName,UserName,MobileNumber,Email,Password,AdminRegdate) value('$aname','$user','$contact1-$contact2','$email','$pass', '$current_timestamp' )");
    if ($query) {
    $msg="Admin profile is added.";
  }
  else
    {
      $msg="Something Went Wrong. Please try again.";
    }
  }
  else{
      $msg = "Password does not match. Try again.";
  }
}
  ?>
<!doctype html>
<html class="no-js" lang="">
<head>
<meta name="viewport" content="width=device-width, initial-scale=0.9, maximum-scale=2.0">
    <title>VPMS - Add Admin</title>
   
    
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
    <style>
		
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
  		-webkit-appearance: none;
  		margin: 0;
		}
		input[type=number] {
  		-moz-appearance: textfield;
		}
	</style>
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
                                <strong>Admin </strong> Profile
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Admin Name</label></div>
                                        <div class="col-12 col-md-9"><input class=" form-control" id="adminname" name="adminname" type="text" required = "true"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="email-input" class=" form-control-label">User Name</label></div>
                                        <div class="col-12 col-md-9"><input class=" form-control" id="username" name="username" type="text" required = "true"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="password-input" class=" form-control-label">Password</label></div>
                                        <div class = "col-12 col-md-9"><input type="password" class=" form-control" name="password"  required="true"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="password-input" class=" form-control-label">Confirm Password</label></div>
                                        <div class = "col-12 col-md-9"><input type="password" class=" form-control" name="confirmpass" required="true"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="password-input" class=" form-control-label">Contact Number</label></div>
                                        <div class="col-12 col-md-2"><input class=" form-control" id="contact1" name="contact1" type="number" required = "true" minlength = "4" maxlength = "4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"></div>-
                                        <div class="col-12 col-md-2"><input class=" form-control" id="contact2" name="contact2" type="number" required = "true" minlength = "7" maxlength = "7" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"></div>
                                     </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Email</label></div>
                                        <div class="col-12 col-md-9"><input class="form-control " id="email" name="email" type="email" required="true"></div>
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