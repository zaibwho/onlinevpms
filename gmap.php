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
    $vehid = $_GET['parkingid'];
    $ret=mysqli_query($con,"select * from stdvehicle  where ID='$vehid'");
    $row=mysqli_fetch_array($ret);
    $reg=$row['RegNo'];
    $fname=$row['FirstName'];
    $lname=$row['LastName'];
    $vehcat=$row['VehicleCategory'];
    $vehcomp=$row['VehicleCompanyname'];
    $vehplate=$row['LicensePlateNo'];
    if(isset($_POST['submit']))
    {
    $slot = $_POST['slot'];
    $queryin=mysqli_query($con, "insert into  stdvehstatus(RegNo,FirstName,LastName,VehicleCategory,VehicleCompanyname,LicensePlateNo,VehicleStatus,ParkSlot,Timing) values('$reg','$fname','$lname','$vehcat','$vehcomp','$vehplate', 'IN','$slot', '$current_timestamp')");
    $queryinupdate = mysqli_query($con, "update stdvehicle set Status = 'IN', ParkSlot = '$slot'  where ID = '$vehid' ");
    $queryslotupdate = mysqli_query($con, "update parkingslot set State = true where Slot = '$slot'"); 
        if ($queryin && $queryinupdate && $queryslotupdate) {
  echo "<script>
          alert('Vehicle is in the Parking');
          location.href = 'dashboard.php';
          </script>";
    }
    else
      {
       $msg = "<script> alert('Something's Wrong. Try Again.'); </script>";       
      }

    }
?>



<!DOCTYPE html>
<html>
  <head>
    <title>Choose the Slot</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
    <link rel="apple-touch-icon" href="images/traffic-jam.png">
    <link rel="shortcut icon" href="images/traffic-jam.png">
    <link rel="stylesheet" type="text/css" href="assets/css/map.css" />

  </head>
  <body>
    <!--The div element for the map -->
    <div id="map"></div>
    <form action="" method="post" enctype="multipart/form-data">
    <input style = "display: none" id = "slot" name = "slot" type = "number">
    <button style = "display: none" id = "submit" name = "submit">Enter</button>
    </form>
     
    <script>

function initMap() {
  const home = { lat: 31.527907, lng: 74.291192 };
  const map = new google.maps.Map(document.getElementById("map"), {
    mapId: "d105bbe2983494c1",
    zoom: 18,
    center: home,
  });

var infowindow, check_loc, loc_confirm, myradius, location, icon; 

location = 0;
loc_confirm = 0;

get_location();

<?php

    $query = mysqli_query($con,"select *from parkingslot where SlotFor = '$vehcat' and State = false");
    $count = 1;
    while($fetch = mysqli_fetch_array($query)){
    ?>
    
   var marker<?php echo $count ?> = new google.maps.Marker({
    position: {lat: <?php echo $fetch['lat']; ?>, lng: <?php echo $fetch['lng']; ?>},
    map,
    title: "<?php echo $fetch['Slot'] ?>",
    label: "<?php echo $fetch['Slot'] ?>",
    icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 20,
            strokeWeight: 2
        },
  });
  console.log(<?php echo $count ?>);
  marker<?php echo $count?>.addListener("click", ()=>{
    if(check_loc == true){            // if the location is in the radius
      console.log("condition listener checked");
    addslot(<?php echo $fetch['Slot'] ?>);      // this is allow user to click on the slot since it will add a listener
    }
  });

<?php $count = $count + 1; } ?>


const circle = {
  onecirlce:{
   center: {lat: 31.516175, lng: 74.339788}       // will change this later
  },
};

for(const one in circle){
myradius = new google.maps.Circle({
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.10,
      map,
      center: circle[one].center,
      radius: 100000,
    });
  };

const locationButton = document.createElement("button");
locationButton.textContent = "Location";
locationButton.classList.add("custom-map-control-button");
map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

locationButton.addEventListener("click", () => {
  get_location();
});

function get_location(){
infoWindow = new google.maps.InfoWindow();
if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };
         determine_loc(pos);
         

  console.log(loc_confirm + " loc_confirm");
  if(pos){
    console.log("pos confirmed");
    
  if(location == 0){
    location = new google.maps.Marker({
        position: pos,
        map,
        icon: icon
        });
      
          map.setCenter(pos);
  }
  else{
    changeMarkerPos(location, pos);
  }
  set_icon();
}
       },
        () => {
          console.log("error 1");
          handleLocationError(true, infoWindow, map.getCenter());
        }
      );
    } else {
      console.log("error 2");
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }
    ++loc_confirm;
}



function determine_loc(pos){
  check_loc = myradius.getBounds().contains(pos);       // return a boolean value if the pos is in bounds.
  console.log(check_loc);
}

function set_icon(){
  if(loc_confirm == 1){
    if(check_loc == true){      // if pos is inside bounds, the icon will be blue.
      icon = 'images/icon_loc_blue.png';
    }
    else{
      icon = 'images/icon_loc_red.png';
    }
  }
  else{
    if(check_loc == true){
      location.setIcon('images/icon_loc_blue.png');
    }
    else{
      location.setIcon('images/icon_loc_red.png');
    }
  }
}

window.setInterval(get_location, 2000);

}



function changeMarkerPos(marker, pos){
  marker.setPosition(pos);
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );
  infoWindow.open(map);
}


function addslot(slot){
  console.log("addslot worked");
  let input = document.getElementById("slot");
  input.value = slot;
  let btn = document.getElementById("submit");
  btn.click();
}

</script>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrPZS6RKKWwcViWPivzfBPhU_XpRFdN_M&callback=initMap&v=weekly"
      async defer
    ></script>
  </body>
</html>
<?php  }?>