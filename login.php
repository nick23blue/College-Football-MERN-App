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

<?php
 require_once 'database.php'; 
				try {
					$myDBconnection = new PDO("mysql:host=$hn;dbname=$db", $un, $pw);
				} catch (PDOException $e) {
					$error_message = $e->getMessage();
					print $error_message . "<br>";
				}
?>

<nav>

<?php include "nav.php"; ?>	
 <?php include "header.php"; ?>	
 <?php include "footer.php"; ?>	

</nav>
<main>
<form action ="login.php" method = "post">
<label for "uname">Username:</label>
<input type = "text" id = "uname" name = "uname">
<label for "pword">Password:</label>
<input type = "text" id = "pword" name = "pword">
<input type="submit" name = "sub" value="Log in">
</form>
</main>

<?php
if(isset($_POST["sub"])){ 
				echo "HELLO3";
					//are all the fields filled out?
					if( !(empty($_POST["uname"])) && !(empty($_POST["pword"]))) {
								echo "HELLO2";
						//put all POST values into variables
						$username = $_POST["uname"];
						$password = $_POST["pword"];
						
						//sanitize each of the fields (send each field to the sanitize function)
						$username =  htmlentities( strip_tags( stripslashes($username)));
						$password =  htmlentities( strip_tags( stripslashes($password)));
						
						//do all the sanitized variables still have a value?
						if( $username != "" && $password != "" ) {
							echo "HELLO";
							//try to insert the information into the database
							try {
								//check to see if your table has the same fields & is spelled the same way
								$query1 = 'SELECT user_name, password FROM customers WHERE user_name = :uname AND password = :pword;';
								$statement = $myDBconnection -> prepare($query1);
								$statement -> bindValue(':uname', $username); 
								$statement -> bindValue(':pword', $password);
								$statement -> execute();
								$result = $statement -> fetch();
							} catch (PDOException $e) {
								$error_message = $e->getMessage();
								echo "<p>An error occurred while trying to retrieve data from the table: $error_message </p>";
							}
							//Does the username match the data in the table? (Task 4, Step 5 a & b)
							if($result){
								echo "You are an authorized user";
								
									
								$_SESSION["uname"] = $username;
								header('Location: index.php');
							}
							else{
								echo "You are not an authorized user";
								session_unset($_SESSION["uname"]); 
	
								session_destroy();  
							}
							
							
							//Was the Remember User Name checkbox checked? (Task 3, Steps 2 & 3)
							
							
							//remember to close IF statement
						} else { //not all sanitized variables have values
							echo "<p>Bad data was inserted into the fields.</p>";
						}			
					} else { //not all fields were filled in
						echo "<p>Not all fields were filled in.</p>";
					}
				} else { //form not submitted
					echo "<p>Form has not been submitted yet.</p>";
				}
				?>

<footer>
  &copy; 2021 &mdash;  <br>
  <a href="mailto:nl02343@georgiasouthern.edu">Contact Me!</a>
</footer>