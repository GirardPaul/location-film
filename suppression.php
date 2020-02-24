<?php
	$bdd = new PDO('mysql:host=localhost:3308;dbname=film', 'root', '');
	$suppression="DELETE FROM film WHERE id=".$_GET['filmid']." ";
	$stmt = $bdd->query($suppression);
	header("Location:liste.php");
	
