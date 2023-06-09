<?php session_start(); 
if(!(isset($_SESSION["UserName"]))){

}
?>
<!DOCTYPE html>
<php lang="en">
<head>
	<!-- 
	Name: Nicholas Lee
	-->
	<title>Lee:Shopping Site</title>
	<meta charset="utf-8">
	 <link href="Lee_styles.css" rel="stylesheet">
</head>
<header>
 <img src="pictures/BeFunky-collage.jpg" alt="collage" width ="900" height = "500"/>
 <h1>Nick's Retro Video Games</h1>
</header>

<?php
 require_once 'database.php'; 
				try {
					$myDBconnection = new PDO("mysql:host=$hn;dbname=$db", $un, $pw);
				} catch (PDOException $e) {
					$error_message = $e->getMessage();
					print $error_message . "<br>";
				}
				
				try {
								
								$query = "SELECT item_name, item_id from items where item_category = 'football';";
								$statement = $myDBconnection -> prepare($query);
								
								$statement -> execute();
								$result1 = $statement -> fetchAll();
							} catch (PDOException $e) {
								$error_message = $e->getMessage();
								echo "<p>An error occurred while trying to retrieve data from the table: $error_message </p>";
							}
							
							
							try {
								
								$query = "SELECT * from items where item_category = 'basketball';";
								$statement = $myDBconnection -> prepare($query);
								
								$statement -> execute();
								$result2 = $statement -> fetchAll();
							} catch (PDOException $e) {
								$error_message = $e->getMessage();
								echo "<p>An error occurred while trying to retrieve data from the table: $error_message </p>";
							}
							
							try {
								
								$query = "SELECT * from items where item_category = 'other';";
								$statement = $myDBconnection -> prepare($query);
								
								$statement -> execute();
								$result3 = $statement -> fetchAll();
							} catch (PDOException $e) {
								$error_message = $e->getMessage();
								echo "<p>An error occurred while trying to retrieve data from the table: $error_message </p>";
							}
							
							try {
								
								$query = "SELECT * from items where item_category = 'action';";
								$statement = $myDBconnection -> prepare($query);
								
								$statement -> execute();
								$result4 = $statement -> fetchAll();
							} catch (PDOException $e) {
								$error_message = $e->getMessage();
								echo "<p>An error occurred while trying to retrieve data from the table: $error_message </p>";
							}
?>
<nav>
 
 <?php include "nav.php"; ?>	
 <?php include "header.php"; ?>	


</nav>
<main>
 <!--<h3>Football Games</h3>
 <ul>
  <li><a href="description.php">ESPN NFL 2k5</a>
  <li><a href="description.php">Madden 07</a>
  <li><a href="description.php">NCAA Football 06</a>
  </ul>
  
  <h3>Basketball Games</h3>
  <ul>
   <li><a href="description.php">NBA Live 2005</a>
   <li><a href="description.php">NBA 2k11</a>
   <li><a href="description.php">NCAA March Madness 2005</a>
   </ul>
   
   <h3>Action</h3>
  <ul>
   <li><a href="description.html">Transformers:War for Cybertron</a>
   <li><a href="description.html">Mortal Kombat Armageddon</a>
   <li><a href="description.html">Transformers:Dark of the Moon</a>
   </ul>
   
   <h3>Other</h3>
   <ul>
   <li><a href="description.php">MVP Baseball 2005</a>
   <li><a href="description.php">Sonic Heroes</a>
   <li><a href="description.php">Dragon Ball Z Budokai 3</a>
</main>-->
<h3>Football Games</h3>
<?php
					foreach ($result1 as $result) { 
			?>
				<ul>
					<li><a href="description.php?item_id=<?php echo $result['item_id'];?>"><?php echo $result['item_name'];?></a></li>
					
				</ul>
			<?php
					} //close foreach
			?>
			<h3>Basketball Games</h3>
			<?php
					foreach ($result2 as $result) { 
			?>
				<ul>
					<li><a href="description.php?item_id=<?php echo $result['item_id'];?>"><?php echo $result['item_name'];?></a></li>
					
				</ul>
			<?php
					} //close foreach
			?>
			
			<h3>Other Games</h3>
			<?php
					foreach ($result3 as $result) { 
			?>
				<ul>
					<li><a href="description.php?item_id=<?php echo $result['item_id'];?>"><?php echo $result['item_name'];?></a></li>
					
				</ul>
			<?php
					} //close foreach
			?>
			
			<h3>Action Games</h3>
			<?php
					foreach ($result4 as $result) { 
			?>
				<ul>
					<li><a href="description.php?item_id=<?php echo $result['item_id'];?>"><?php echo $result['item_name'];?></a></li>
					
				</ul>
			<?php
					} //close foreach
			?>
</main>
 <?php include "footer.php"; ?>	