<?php
  if(isset($_SESSION["uname"])){
	  
  
?>
	
		
		<ul>
			<a href="index.php">Home</a>
			<a href="profile.php">Profile</a>
			<a href="items.php">Items Available</a>
			<a href="cart.php">View Cart</a>
			<a href="logout.php">Logout</a>
		</ul>
		<?php
  }
  else{
	  
		?>




		
		<ul>
			<a href="index.php">Home</a>
			<a href="register.php">Register</a>
			<a href="login.php">Login</a>
		</ul>
  <?php
  }
  ?>