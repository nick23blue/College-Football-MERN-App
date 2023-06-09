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

 
 <?php include "nav.php"; ?>	
 <?php include "header.php"; ?>	


</nav>
<main>

   <p> <?Php echo $_SESSION["uname"];?>, You are logged in</p>
   
   <p>Please sign up or Log in</p>
   <p> Nick's Retro Video Games is a site for people who love video games. On this site are some retro video games that are availble for purchase.
   I have been an avid gamer for as long as I can remember and I hope we can share that same characteristic.</p>
	  
  <p>Video games have always been something that eases my mind. My favorite genre of games is sports. With this site I hope you can relieve some memories with retro video games.</p>

  <p>Relive your childhood or try out some retro games by making a purchase</p>
</main>
 <?php include "footer.php"; ?>	