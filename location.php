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
    color: white;
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
h1{
    font-family: 'Bangers', cursive;
    color: black;

}
strong{
    font-family: 'Bangers', cursive;

}
option{
    color: black;
}
.centrer{
    position: absolute;
  top: 50%; left: 50%;
  transform: translate(-50%, -50%);
}
</style>
    <title>Document</title>
</head>
<body>

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
        <li class="nav-item active">
          <a class="nav-link" href="location.php">Louer un film</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="recapitulatif.php">Recap</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="inscription.php">S'inscrire</a>
        </li>
      </ul>
    </div>
  </nav>

</header>
<!--Main Navigation-->

<div class="container pt-5 mt-5">
<?php


//Connexion à la base données
$bdd = new PDO("mysql:host=localhost:3308;dbname=film;", "root", "");

//Création du formulaire
echo "<form class='centrer' action='' method='post'>";

echo "<h1>Louer un film :</h1>";


echo "<table class='table'>";
echo "<tbody>";
echo "<thead>
<tr>
  <th scope='col'>#Film</th>
  <th scope='col'>#Nom</th>
  <th scope='col'>#Début</th>
  <th scope='col'>#Fin</th>
</tr>
</thead>";
//Création et éxecution des requêtes client et film
$film = "SELECT * FROM film";

$client = "SELECT * FROM client";

$req_film = $bdd->query($film);

$req_client = $bdd->query($client);



//Création du premier select qui récupère les films
echo"<tr>";
echo"<td>";
echo "<select  class='custom-select' id='inputGroupSelect04' aria-label='Example select with button addon' name='film'>";
while ($list_film=$req_film->fetch()){ 
    echo "<option value='".$list_film['id']."'>".$list_film['nom']."</option>";
}
echo "</select>";
echo"</td>";
//Création du premier select qui récupère les clients
echo "<td>";
echo "<select class='custom-select' id='inputGroupSelect04' aria-label='Example select with button addon' name='client'>";
while ($list_client=$req_client->fetch()){ 	
    echo "<option value='".$list_client['id']."'>".$list_client['nom_client']."</option>";
}
echo "</select>";
echo "</td>";

echo"<td>";
echo "<input id='inputMDEx' class='form-control' style='margin-right: 5px; margin-left:5px;' type='date' name='debut_loc'>";
echo"</td>";
echo"<td>";
echo "<input id='inputMDEx' class='form-control' style='margin-right: 5px; margin-left:5px;' type='date' name='fin_loc'>";
echo"</td>";
echo"</tr>";
echo "</tbody>";
echo "</table>";

echo "<input class='w-100 ml-1 mt-1 mb-3 btn btn-dark btn-lg btn-block' type='submit' value='Envoyer'>";

//Envoi des données pour la location
if(isset($_POST['film']) && isset($_POST['client'])){

    $debut_loc = $_POST['debut_loc'];
    $fin_loc = $_POST['fin_loc'];


    //Création de la requête pour les données de location
    $ajout_loc = "INSERT INTO loc (id_film, id_client, debut_loc, fin_loc) VALUES ('".$_POST['film']."', '".$_POST['client']."', '$debut_loc', '$fin_loc')";

    $req_loc = $bdd->query($ajout_loc);

    header("Location:liste.php");

}

echo "</form>";
?>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>









