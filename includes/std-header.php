<?php 

$Studentid=$_SESSION['stdid'];
$ret=mysqli_query($con,"select * from student  where session_id='$Studentid'");
$row=mysqli_fetch_array($ret);

?>

<div id="right-panel" class="right-panel">
    <header id="header" class="header">
        <div class="top-left">
            <div class="navbar-header">
                <a id="menuToggle" class = "btn-t"><i class="fa-solid fa-bars"></i></a>
                <div class = "wel">
                    Welcome <?php  echo $row['FirstName'];?>
                </div>
            </div>
        </div>
                
        <div class="top-right">
            <div class="header-menu">
                <div class="header-left">
                        
                    <div class="form-inline">
                           
                    </div>

                     
                </div>
                <a href = "add-vehicle.php" class = "floating-icon fa-solid fa-plus"></a>
                   
                <div class="user-area dropdown float-right">
                        
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fa-circle-user" style = "font-size: 36px"></i>
                    </a>

                    <div class="user-menu dropdown-menu">
                        <a class="nav-lin" href="change-password.php">Change Password</a><br>

                        <a class="nav-lin" href="index.php">Logout</a>
                    </div>
                </div>

            </div>
        </div>
        </header>