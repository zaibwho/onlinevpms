
<nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <div>
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <div class = "wel">
                    Welcome <?php  echo $row['FirstName'];?>
              </div>
              </div>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
              
          
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard.php"><span class = "right-away fa-solid fa-laptop"></span>Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="change-password.php"><span class = "right-away fa-solid fa-key"></span>Change Password</a>
                </li>
               <li class="nav-item">
                    <a class="nav-link" href="logout.php"><span class = "right-away fa-solid fa-arrow-right-from-bracket"></span>Logout</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>-->
              </ul>
            </div>
</div>

          <a href = "add-vehicle.php" class = "floating-icon fa-solid fa-plus"></a>
        </nav>
        