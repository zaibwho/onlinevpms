<?php
include('includes/time.php');
include('path.php');
session_start();

include('includes/dbconnection.php');
include('includes/randomstring.php');

if (isset($_SESSION['stdid']) && strlen($_SESSION['stdid']) != 0) {
    header('location:dashboard.php');
    exit();
} else {
    if (isset($_POST['login'])) {
        $Reg = mysqli_real_escape_string($con, $_POST['StdReg']);
        $password = md5(mysqli_real_escape_string($con, $_POST['password']));
        
        $query = mysqli_query($con, "SELECT ID FROM student WHERE RegNo='$Reg' AND Password='$password'");
        $ret = mysqli_fetch_array($query);
        
        if ($ret) {
            $new_session_id = generateRandomString();
            $update_id_query = mysqli_query($con, "UPDATE student SET session_id = '$new_session_id' WHERE RegNo = '$Reg'");
            
            if ($update_id_query) {
                $_SESSION['stdid'] = $new_session_id;
                header('location:dashboard.php');
                exit();
            } else {
                $msg = "Error updating session.";
            }
        } else {
            $msg = "Invalid Details.";
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <title>VPMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="images/traffic-jam.png">
    <link rel="shortcut icon" href="images/traffic-jam.png">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
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
                    <h3 class="mb-4 text-center" style="font-weight: bold">Student Login</h3>
                    <form action="#" method="post" class="signin-form">
                        <p style="font-size:16px; color:red" align="center">
                            <?php if (isset($msg)) {
                                echo $msg;
                            } ?>
                        </p>
                        <div class="form-group">
                            <input id="num" type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="7" class="form-control" placeholder="Student ID" name="StdReg" required>
                        </div>
                        <div class="form-group">
                            <input id="password-field" type="password" class="form-control" name="password" placeholder="Password" required>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="login" class="form-control btn btn-primary submit px-3">Sign In</button>
                        </div>
                    </form>
                    <a href="<?php echo $path ?>/admin" class="floating-icon"><i class="fa fa-id-badge"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/login.js"></script>

</body>
</html>

<?php } ?>
