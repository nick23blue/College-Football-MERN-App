<?php session_start(); ?>
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

<?php
				//Connect to DB
				require_once 'database.php'; 
				try {
					$myDBconnection = new PDO("mysql:host=$hn;dbname=$db", $un, $pw);
				} catch (PDOException $e) {
					$error_message = $e->getMessage();
					print $error_message . "<br>";
				}
				?>

 
 <?php include "nav.php"; ?>	
 <?php include "header.php"; ?>	
 <?php include "footer.php"; ?>	

</nav>


<?php
				if(isset($_POST["sub"])){
				 if( !empty( $_POST["uname"] ) && !empty( $_POST["pword"]) ) {
					$a= htmlentities(strip_tags(stripslashes($_POST["uname"])));				 
                    $b= htmlentities(strip_tags(stripslashes($_POST["pword"])));				 
                    $today = date("Y-m-d");  
					
					try{
						$selection = $query = 'INSERT INTO customers (user_name, password, date_created) VALUES (:user_name, :password, :date_created)';
						$dbquery = $myDBconnection -> prepare($selection);
				 $dbquery -> bindValue(':user_name', $a); 
				 $dbquery -> bindValue(':password', $b); 
				 $dbquery -> bindValue(':date_created', $today); 
				 
                 $dbquery -> execute();
				 echo "A new purchase record was created successfully";
					}
					catch (PDOException $e) {
                    $error_message = $e -> getMessage(); 
					}
					  echo $a." " .$b;
				 }else {
					 echo "not all the fields were filled in";
				 }
				}else{
					 "the form has not been submitted";
				 }
					 
			?>


<main>
<form action ="register.php" method = "post">
<label for "uname">Username:</label>
<input type = "text" id = "uname" name = "uname">
<label for "pword">Password:</label>
<input type = "text" id = "pword" name = "pword">
<input type="submit" name = "sub" value="Register">
</form>
</main>
<footer>
  &copy; 2021 &mdash;  <br>
  <a href="mailto:nl02343@georgiasouthern.edu">Contact Me!</a>
</footer>