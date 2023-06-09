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

<?php
				//Connect to DB
				require_once 'database.php'; 
				try {
					$myDBconnection = new PDO("mysql:host=$hn;dbname=$db", $un, $pw);
				} catch (PDOException $e) {
					$error_message = $e->getMessage();
					print $error_message . "<br>";
				}
				try {
					$query = 'SELECT item_name, item_desc FROM items';
					$dbquery = $myDBconnection -> prepare($query);
					$dbquery -> execute();
					$results = $dbquery -> fetchAll();	
				} catch (PDOException $e) {
					$error_message = $e->getMessage();
					echo "<p>An error occurred while selecting data from the table: $error_message </p>";
				}
				?>

<nav>

 
 <?php include "nav.php"; ?>	
 <?php include "header.php"; ?>	


</nav>
<main>
 
 <?php
			 $x =$_GET['item_id'];
			 if($x != ""){
			 
			 require_once 'database.php'; 
				try {
					$myDBconnection = new PDO("mysql:host=$hn;dbname=$db", $un, $pw);
				} catch (PDOException $e) {
					$error_message = $e->getMessage();
					print $error_message . "<br>";
				}
			   try {
					$query = 'SELECT * FROM items WHERE item_id =:x';
					$dbquery = $myDBconnection -> prepare($query);
					$dbquery -> bindValue(":x", $x);
					$dbquery -> execute();
					$results = $dbquery -> fetchAll();	
				} catch (PDOException $e) {
					$error_message = $e->getMessage();
					echo "<p>An error occurred while selecting data from the table: $error_message </p>";
				}
				
				if($results){
					foreach($results as $result) {
				   echo '<h3>' . $result['item_name'], '</h3>';
                   echo $result['item_desc'], '<br>';
                   echo $result['item_price'], '<br>';
                   echo '<img src='.$result['item_image_name'].' alt = "regular"> ';
                   echo $result['item_category'], '<br>';
                   echo $result['cust_id'], '<br>';
                   echo $result['review_date'], '<br>';
                   echo $result['review_desc'], '<br>';
         } 
				}else{
					echo "try google";
				}
				
				
				
			 } else {
				 echo "No games, try again";
			 }
			 
			 
			 ?>
 <h3><?php echo 'item_name'?></h3>
 
 
 <?php
 try {
					$query = 'SELECT review_desc, review_date FROM reviews';
					$dbquery = $myDBconnection -> prepare($query);
					$dbquery -> execute();
					$result1 = $dbquery -> fetchAll();	
				} catch (PDOException $e) {
					$error_message = $e->getMessage();
					echo "<p>An error occurred while selecting data from the table: $error_message </p>";
				}
 ?>
 <?php
					foreach ($result1 as $result) { 
			?>
				
					<p><?php echo $result['review_desc'];?><?php echo $result['review_date'];?></p>
					
				
			<?php
					} //close foreach
			?>
 
  
   <body>
    
	<form method="POST" class="clean">
			<input type="submit" value="Add to Cart" class="cartButton" name="Gamecart">
		</form> 
 <?php
			
				
				if(isset($_POST['Gamecart'])) {
				
					
								
								try {
									echo $login;
									$query = "SELECT cust_id FROM customers WHERE user_name = :un";
									$dbquery = $myDBconnection -> prepare($query);
									$dbquery -> bindValue(':un', $login);
									$dbquery -> execute();
									$result = $dbquery -> fetch();
									echo $result['cust_id'];
									$query = "INSERT INTO carts (item_id, cust_id, date_added, item_quantity) VALUES (:i_id, :c_id, :da, :iq)";
									$dbquery = $myDBconnection -> prepare($query);
									$dbquery -> bindValue(':i_id', $x);
									$dbquery -> bindValue(':c_id', $result['cust_id']);
									$dbquery -> bindValue(':da', date('Y-m-d H:i:s'));
									$dbquery -> bindValue(':iq', 1);
									
									$dbquery -> execute();
									
								} catch (PDOException $e) {
									$error_message = $e -> getMessage();
									echo $error_message . "<br>";
								}
								echo "form submitted";
							
				} else {
					echo "The form has not been submitted.";
				}
			?>
 
   
   
   
   
   
   <form action = "description.php" method = "post"/>
   <textarea name = "comment" form = "userform">Write Review</textarea>
   <input type="submit" value="Post Review">
   


   
</main>
 <?php include "footer.php"; ?>	