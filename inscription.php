<!DOCTYPE html>
<html lang="en" class="full-height">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bangers&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="mdb.css">



<style>

*{
    font-family: 'Roboto Condensed';
    color: black;
}
.film-modif{
    color: black;
}
.film-modif:hover{
    color: black;
}
.film-suppr{
    color: black;
}
.film-suppr:hover{
    color: black;
}
a:hover{
    text-decoration: none;
}
body{
    background-color: #707070;
}
.nav-link{
    font-family: 'Bangers', cursive;

}
strong{
    font-family: 'Bangers', cursive;
    color: white;

}
.centrer{
    position: absolute;
  top: 50%; left: 50%;
  transform: translate(-50%, -50%);
}
.form-control::placeholder {
  color: white;
}




</style>
    <title>Document</title>
</head>
<body >

<!--Main Navigation-->
<header class="bg-dark">

  <nav class="navbar fixed-top navbar-expand-lg bg-dark navbar-dark pink scrolling-navbar">
    <a class="navbar-brand" href="liste.php"><strong>Paul Movizzz</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="liste.php">Accueil <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ajout.php">Ajouter un film</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="location.php">Louer un film</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="recapitulatif.php">Recap</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="inscription.php">S'inscrire</a>
        </li>
      </ul>
  </nav>

</header>
<!--Main Navigation-->


<div class="container mt-5">
<?php

$bdd = new PDO('mysql:host=localhost:3308;dbname=film', 'root', '');

echo "<form class='centrer d-flex flex-column justify-content-center' action='' method='post'>";

echo "<div class='md-form'>";
echo "<input type='text' id='form1' class='text-dark text-center form-control' name='ajout_prenom_client' placeholder='Prenom'><br>";
echo "<input type='text' id='form1' class='text-dark text-center form-control' name='ajout_nom_client' placeholder='Nom'><br>";

echo "<input type='submit' class='btn btn-dark btn-lg btn-block' value='Ajouter'>";
echo "</div>";	

echo "</form>";

if(isset($_POST['ajout_prenom_client']) AND isset($_POST['ajout_nom_client'])){
    
    $prenom_client = $_POST['ajout_prenom_client'];
    $nom_client = $_POST['ajout_nom_client'];

    $ajout = "INSERT INTO client (prenom, nom_client) VALUES('$prenom_client', '$nom_client')";
    $req = $bdd->query($ajout);
        
    header("Location:liste.php");
    
}
?>

</div>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

