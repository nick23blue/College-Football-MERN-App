<?php session_start(); 
if(!(isset($_SESSION["UserName"]))){

}
?>
<!DOCTYPE html>
<html lang="en">
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
<nav>

 
 <?php include "nav.php"; ?>	
 <?php include "header.php"; ?>	


</nav>

<?php
 require_once 'database.php'; 
				try {
					$myDBconnection = new PDO("mysql:host=$hn;dbname=$db", $un, $pw);
				} catch (PDOException $e) {
					$error_message = $e->getMessage();
					print $error_message . "<br>";
				}
				?>
				
				
	
<main>
<h3>Welcome Username</h3>
<form action ="/profile.php" method ="post">
 <label for= "image">New Image</label><br>
 <input type="file" id="myfile" name="myfile"><br>
 <label for="loc">Location</label><br>
 <input type="text" id="loc" name="loc"><br>
 <label for="age-range">Age Range:</label>
 <select name="age-range" id="age-range">
  <option value="10-20">10-14</option>
  <option value="20-30">20-30</option>
  <option value="30-40">30-40</option>
  <option value="40-50">40-50</option>
  <input type="radio" id="male" name="gender" value="male">
 <label for="male">Male</label><br>
 <input type="radio" id="female" name="gender" value="female">
 <label for="female">Female</label><br>
 <input type="radio" id="other" name="gender" value="other">
 <label for="other">Prefer Not To Answer</label><br>
</select>
 <input type="submit" value="Update Profile">
</form>
</main>
<?php include "footer.php"; ?>	