<nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

          <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li id = "dash" class="nav-item">
                    <a class="nav-link" href="dashboard.php"><span class = "right-away fa-solid fa-laptop"></span>Dashboard</a>
                </li>
                <li id = "profile" class="nav-item">
                    <a class="nav-link" href="profile.php"><span class = "right-away fa-solid fa-user"></span>Profile</a>
                </li>
                <li id = "password" class="nav-item">
                    <a class="nav-link" href="change-password.php"><span class = "right-away fa-solid fa-key"></span>Change Password</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><span class = "right-away fa-solid fa-arrow-right-from-bracket"></span>Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <script defer>

          let dashboard = document.getElementById("dash");
          let profile = document.getElementById("profile");
          let password = document.getElementById("password");

          let path = window.location.pathname;
          let page = path.split("/").pop();
          let active = "active";

         //console.log(page);
         if(page == "dashboard.php"){
          if(!dashboard.classList.contains(active)){
            dashboard.classList.add(active);
          }
          if(profile.classList.contains(active)){
            profile.classList.remove(active);
          }
          else if(password.classList.contains(active)){
            password.classList.remove(active);
          }
         }
         else if(page == "profile.php"){
          if(!profile.classList.contains(active)){
            profile.classList.add(active);
          }
          if(dashboard.classList.contains(active)){
            dashboard.classList.remove(active);
          }
          else if(password.classList.contains(active)){
            password.classList.remove(active);
          }
         }
         else if(page == "change-password.php"){
          if(!password.classList.contains(active)){
            password.classList.add(active);
          }
          if(profile.classList.contains(active)){
            profile.classList.remove(active);
          }
          else if(dashboard.classList.contains(active)){
            dashboard.classList.remove(active);
          }
         }
        </script>