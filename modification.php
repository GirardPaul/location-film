<?php 

//echo $_GET['filmid'];
//die;

try {
	
$bdd = new PDO('mysql:host=localhost:3308;dbname=film', 'root', '');
}
 catch (PDOException $e) {
print "Erreur !: " . $e->getMessage() . "<br/>";
die();
}


$sql="SELECT * FROM film WHERE id=".$_GET['filmid']." ";
$req = $bdd->query($sql);



echo "<form action='' method='post'>";
while ($film=$req->fetch()){

	echo $film['id']." <input type='text' name='nomfilm' value='".$film['nom']."'>";
	
}
echo "<input type='submit' value='modifier'>";
echo "</form>";

//var_dump($_POST);

if(isset($_POST['nomfilm'])){
	
    $update="UPDATE film SET nom='".$_POST['nomfilm']."' WHERE id=".$_GET['filmid']." ";
    
    $stmt = $bdd->query($update);
    
    header("Location:liste.php");

}
