<?php session_start(); 
if(!(isset($_SESSION["uname"]))){
 header('Location: index.php');
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
<main>
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
								
								$dbquery = 'SELECT item_name, items.item_id, item_price, cart_id,item_quantity, date_added  FROM carts, items, customers WHERE items.item_id = carts.item_id AND carts.cust_id = customers.cust_id AND user_name = :user;';
								
								$statement = $myDBconnection -> prepare($dbquery);
								
								$statement -> bindValue(':user', $login);
								
								$statement -> execute();
								
								$results = $statement -> fetchAll();
								
								//print_r($results);
							} catch (PDOException $e) {
								$error_message = $e->getMessage();
								echo "<p>An error occurred while trying to retrieve data from the table: $error_message </p>";
							}
				?>
				<?php
				/*foreach ($results as $result) { 
				  
				   echo $result['item_name'],['item_id'],['cart_id'];
				   echo $result['item_quantity'];
				   echo $result['item_price'];
				   echo $result['date_added'];
				}*/
			?>
			
<table>
    <form action="cart.php" method="POST" class="clean">
				<tr>
					<th>Name</th>
					<th>Cost</th>
					<th>Quantity</th>
					<th>Delete</th>
					<th>Date Added</th>
					<th>Total</th>
					<th>Grand Total</th>
				</tr>
			<?php
					foreach ($results as $row) { 
					
			?>
			
			<?php
			   $gt = $gt + ($row['item_price'] * $row ['item_quantity']);
			   ?>
				<tr>
					<td><a href="description.php?item_id=<?php echo $row['item_id'];?>"><?php echo $row['item_name'];?></a></td>
					<td><?php echo $row['item_price']; ?></td>
					<td><input type="text" value = "<?php echo $row['item_quantity']; ?>" name="iq<?php echo $row['cart_id']?>"></td>
					<td>  <input type="submit" value="Delete" name= "delete<?php echo $row['cart_id']?>"></td>
					<td><?php echo $row['date_added']; ?></td>
					<td><?php $itotal = $row['item_price'] * $row['item_quantity']; echo $itotal; ?></td>
				</tr>
					<?php }?>
					<input name="Change" type="submit" value="Change Cart Contents" class="cartButton" >
		
				</table>
				<?php echo "Grand Total",$gt ?>
				<form>
				 <br>
				 </form>
			
			
			<?php
			
			if (isset($_POST['Change'])) {
				foreach ($results as $row) { 
				try {
								

								$dbquery = 'update carts set item_quantity = :iq  where  cart_id = :cid';
								
								$statement = $myDBconnection -> prepare($dbquery);
								
								$iq = "iq". $row['cart_id'];
								
								$statement -> bindValue(':iq', $_POST[$iq]); 
								
								$statement -> bindValue(':cid', $row['cart_id']);
								
								$statement -> execute();
								
								$results = $statement -> fetchAll();
								
								
							} catch (PDOException $e) {
								$error_message = $e->getMessage();
								echo "<p>An error occurred while trying to retrieve data from the table: $error_message </p>";
							}
			}
			}
				?>
				
				
				<?php
			
			foreach($results as $row){
				$delete = "delete". $row['cart_id'];
			if (isset($_POST[$delete])) {
				try {
								
             
								$dbquery = 'Delete from  carts WHERE cart_id= :cid';
								
								$statement = $myDBconnection -> prepare($dbquery);
								
								
								$statement -> bindValue(':cid', $row['cart_id']); 
								
								
								
								$statement -> execute();
								
								
								
								
							} catch (PDOException $e) {
								$error_message = $e->getMessage();
								echo "<p>An error occurred while trying to retrieve data from the table: $error_message </p>";
							}
							
			}
				      
			}	
				?>
			
			
			<?php
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}
?>
			

<?php

if (isset($_POST['item_id'], $_POST['item_quantity']) && is_numeric($_POST['item_id']) && is_numeric($_POST['item_quantity'])) {
   
    $product_id = (int)$_POST['item_id'];
    $quantity = (int)$_POST['item_quantity'];

    $stmt = $pdo->prepare('SELECT * FROM items WHERE id = ?');
    $stmt->execute([$_POST['item_id']]);
    
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product && $quantity > 0) {
       
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
               
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
}
   
 
    exit;
	?>



  
</main>
 <?php include "footer.php"; ?>	