<?php
date_default_timezone_set('Asia/Karachi');

session_start();

include('includes/dbconnection.php');
include('includes/randomstring.php');
include('../path.php');

// Initialize $msg to avoid undefined variable warning
$msg = "";

// Check if session 'stdaid' is set
if (isset($_SESSION['stdaid']) && strlen($_SESSION['stdaid']) != 0) {
    header('location:dashboard.php');
    exit;
}

if (isset($_POST['login'])) {
    $adminuser = $_POST['username'];
    $password = md5($_POST['password']);
    $query = mysqli_query($con, "SELECT ID FROM stdadmin WHERE UserName='$adminuser' AND Password='$password'");
    $ret = mysqli_fetch_array($query);

    if ($ret > 0) {
        $new_session_id = generateRandomString();
        $update_id_query = mysqli_query($con, "UPDATE stdadmin SET session_id = '$new_session_id' WHERE UserName = '$adminuser'");

        if ($update_id_query) {
            $_SESSION['stdaid'] = $new_session_id;
            header('location:dashboard.php');
            exit;
        } else {
            echo 'Error updating session.';
        }
    } else {
        $msg = "Invalid Details.";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Admin - VPMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="images/traffic-jam.png">
    <link rel="shortcut icon" href="images/traffic-jam.png">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body class="img" style="background-image: url(images/login-bg1.jpg);">
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section" style="font-weight: bold">Vehicle Parking Management System</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center" style="color: white; background-color: #dc2222af; border-radius: 20px; font-weight: bold;">Administration Login</h3>
                    <form action="#" method="post" class="signin-form">
                        <p style="font-size:16px; color:red" align="center"><?php if ($msg) { echo $msg; } ?></p>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name="username" required>
                        </div>
                        <div class="form-group">
                            <input id="password-field" type="password" class="form-control" name="password" placeholder="Password" required>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="login" class="form-control btn btn-primary submit px-3">Sign In</button>
                        </div>
                    </form>
                    <a href="<?php echo $parentpath ?>" class="floating-icon"><i class="fa fa-user"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/login.js"></script>

</body>
</html>
