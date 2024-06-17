
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
     
				<h5><a href="dashboard.php" class="logo">VPMS</a></h5>
        <ul class="list-unstyled components mb-5">
          <li class="active">
            <a href="dashboard.php"><span class="fa-solid fa-laptop"></span><p class = "inline-block">Dashboard</p></a>
          </li>
          <li>
          <a href="add-vehicle.php"><span class="fa-solid fa-car"></span><p class = "inline-block">Add Vehicle</p></a>
          </li>
          <li>
          <a href="vehicle-log.php"><span class="fa-solid fa-file-lines"></span><p class = "inline-block">Vehicle Logs</p></a>
          </li>
         <li>
         <a href="delete-vehicle.php"><span class="fa-solid fa-trash"></span><p class = "inline-block">Delete Vehicle</p></a>
          </li>
         <!-- <li>
            <a href="#"><span class="fa fa-paper-plane"></span> Contacts</a>
          </li>-->
        </ul>
        <div class="footer">
        	<p>
					  Copyright &copy;2021-<script>document.write(new Date().getFullYear());</script>.<br>Noman Minhas<br>Ahmad Amin 
					</p>
        </div>
    	</nav>

<?php
if($row['sidebar'] == 0){
  echo "<script defer>
  let sidebar2 = document.getElementById('sidebar');
  let active2 = 'active';
  if(sidebar2.classList.contains(active2)){
    sidebar2.classList.remove(active2);
  }

</script>";
}
else{
  echo "<script defer>
  let sidebar2 = document.getElementById('sidebar');
  let active2 = 'active';
  if(!sidebar2.classList.contains(active2)){
    sidebar2.classList.add(active2);
  }

</script>";
}

?>

