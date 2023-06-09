<?php 
date_default_timezone_set("America/New_York");
?>


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


<?php
 
 if(isset($_SESSION["uname"])){
	 $login= $_SESSION["uname"];
 }else{
	$login = "Guest"; 
 }
 echo $login;
?>