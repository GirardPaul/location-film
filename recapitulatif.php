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
</style>
    <title>Document</title>
</head>
<body>

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
        <li class="nav-item active">
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

$bdd = new PDO('mysql:host=localhost:3308;dbname=film', 'root', '');

$req = $bdd->query("SELECT nom, nom_client, prenom, debut_loc, fin_loc
                    FROM film 
                    INNER JOIN loc 
                    ON film.id = loc.id_film
                    JOIN client
                    ON loc.id_client = client.id");

echo "<h1>Liste de tous les films loués :</h1>";


echo "<table class='table'>";
echo "<tbody>";
echo "<thead>
<tr>
  <th scope='col'>#Films</th>
  <th scope='col'>#Prénom</th>
  <th scope='col'>#Nom</th>
  <th scope='col'>#Début</th>
  <th scope='col'>#Fin</th>
  <th scope='col'>#Durée</th>
</tr>
</thead>";
while ($list_loc=$req->fetch()){
        
    $debut_loc = $list_loc['debut_loc'];
    setlocale(LC_TIME, "fr_FR", "French");
    $date_debut = utf8_encode(strftime('%A %d %B %G', strtotime($debut_loc)));

    $fin_loc = $list_loc['fin_loc'];
    setlocale(LC_TIME, "fr_FR", "French");
    $date_fin = utf8_encode(strftime('%A %d %B %G', strtotime($fin_loc)));

    $date1=date_create($debut_loc);
    $date2=date_create($fin_loc);
    $diff=date_diff($date1,$date2);
    $duree = $diff->format("%a jours");

    echo "<tr><td>".$list_loc['nom']."</td><td>".$list_loc['prenom']."</td><td>".$list_loc['nom_client']."</td><td>".$date_debut."</td><td>".$date_fin."</td><td>".$duree."</td></tr>";

    // echo "<li>"."Le film ".$list_loc['nom'].' a été loué par '.$list_loc['prenom'].' '.$list_loc['nom_client']. ' le ' .$date_debut. " jusqu'au " .$date_fin. ' pour une durée de ' .$duree. "</li>";

}
echo "</tr>";
echo "</tbody>";
echo "</table>";









echo "<form class='mt-5' action='' method='post'>";

echo "<h1 class='mb-5'>Liste des films loués par une personne :</h1>";


$req_loc = $bdd->query("SELECT * FROM client");

echo "<select  class='w-50 custom-select' id='inputGroupSelect04' aria-label='Example select with button addon' name='locataire'>";
while ($list_loc=$req_loc->fetch()){
    echo "<option class='text-dark' value='".$list_loc['id']."'>".$list_loc['nom_client']."</option>";
}
echo "</select>";

echo "<input class='w-50 mt-1 mb-3 btn btn-dark btn-lg btn-block' type='submit' name='ajout' value='Rechercher'>";











if(isset($_POST['locataire'])){

    $loc_list = $bdd->query("SELECT nom, id_film, id_client, nom_client, prenom, debut_loc, fin_loc
    FROM film 
    INNER JOIN loc 
    ON film.id = loc.id_film
    JOIN client
    ON loc.id_client = client.id
    WHERE id_client = '".($_POST['locataire'])."'");


    echo "<table class='table'>";
    echo "<tbody>";
    echo "<thead>
    <tr>
      <th scope='col'>#Prénom</th>
      <th scope='col'>#Nom</th>
      <th scope='col'>#Films</th>
      <th scope='col'>#Durée</th>
    </tr>
    </thead>";


while ($list=$loc_list->fetch()){

    $debut_loc = $list['debut_loc'];
    $fin_loc = $list['fin_loc'];

    $date1=date_create($debut_loc);
    $date2=date_create($fin_loc);
    $diff=date_diff($date1,$date2);
    $duree = $diff->format("%a jours");

    echo "<tr><td>".$list['prenom']."</td><td>".$list['nom_client']."</td><td>".$list['nom']."</td><td>".$duree."</td></tr>";
}
echo "</tr>";
echo "</tbody>";
echo "</table>";



}
echo "</form>";











echo "<form class='mt-5'  action='' method='post'>";

echo "<h1 class='mb-5'>Liste des films loués :</h1>";


$req_film = $bdd->query("SELECT * FROM film");

echo "<select class='w-50 custom-select' id='inputGroupSelect04' aria-label='Example select with button addon' name='list_film'>";
while ($list_film=$req_film->fetch()){ 
    echo "<option class='text-dark' value='".$list_film['id']."'>".$list_film['nom']."</option>";
}
echo "</select>";

echo "<input class='w-50 mt-1 mb-3 btn btn-dark btn-lg btn-block' type='submit' name='recherche' value='Rechercher'>";


if(isset($_POST['list_film'])){

   $list_film = $bdd->query("SELECT nom, id_film, id_client, nom_client, prenom, debut_loc, fin_loc
    FROM client 
    INNER JOIN loc 
    ON client.id = loc.id_client
    JOIN film
    ON loc.id_film = film.id
    WHERE id_film = '".($_POST['list_film'])."'");

    
echo "<table class='table'>";
echo "<tbody>";
echo "<thead>
<tr>
  <th scope='col'>#Film</th>
  <th scope='col'>#Prenom</th>
  <th scope='col'>#Nom</th>
  <th scope='col'>#Durée</th>
</tr>
</thead>";


while ($film_list=$list_film->fetch()){

    $debut_loc = $film_list['debut_loc'];
    $fin_loc = $film_list['fin_loc'];

    $date1=date_create($debut_loc);
    $date2=date_create($fin_loc);
    $diff=date_diff($date1,$date2);
    $duree = $diff->format("%a jours");

    echo "<tr><td>".$film_list['nom']."</td><td>".$film_list['prenom']."</td><td>".$film_list['nom_client']."</td><td>".$duree."</td></tr>";
}
echo "</tr>";
echo "</tbody>";
echo "</table>";
}
echo "</form>";







































echo "<form class='mt-5 mb-5' style='margin-top:10px;' action='' method='post'>";


echo "<h1 class='mb-5'>Trie des locations par durée :</h1>";

echo "<div class='md-form w-50'>";

echo "<input id='inputMDEx' class='form-control' style='margin-right: 5px; margin-left:5px;' type='date' name='tri_debut'>
<label class='text-white' for='inputMDEx'>Date de début :</label>";

echo "</div>";

echo "<div class='md-form mt-5 w-50'>";

echo "<input id='inputMDEx' class='form-control' style='margin-right: 5px; margin-left:5px;' type='date' name='tri_fin'>
<label class='text-white' for='inputMDEx'>Date de fin :</label>";
// echo "<input style='margin-right: 5px;' type='date' name='tri_fin'>";
echo "</div>";


echo "<input class='w-50 ml-1 mt-1 mb-3 btn btn-dark btn-lg btn-block' type='submit' name='tri' value='Rechercher'>";

if(isset($_POST['tri_debut']) AND isset($_POST['tri_fin'])){

    $tri_list = $bdd->query("SELECT *
    FROM film 
    INNER JOIN loc 
    ON film.id = loc.id_film
    JOIN client
    ON loc.id_client = client.id
    WHERE loc.debut_loc AND loc.fin_loc BETWEEN '".($_POST['tri_debut'])."' AND '".($_POST['tri_fin'])."'");

echo "<table class='table'>";
echo "<tbody>";
echo "<thead>
<tr>
  <th scope='col'>#Prénom</th>
  <th scope='col'>#Nom</th>
  <th scope='col'>#Films</th>
  <th scope='col'>#Début</th>
  <th scope='col'>#Fin</th>
</tr>
</thead>";

while ($tri=$tri_list->fetch()){

    $debut_loc = $tri['debut_loc'];
    setlocale(LC_TIME, "fr_FR", "French");
    $date_debut = utf8_encode(strftime('%A %d %B %G', strtotime($debut_loc)));

    $fin_loc = $tri['fin_loc'];
    setlocale(LC_TIME, "fr_FR", "French");
    $date_fin = utf8_encode(strftime('%A %d %B %G', strtotime($fin_loc)));

    $date1=date_create($debut_loc);
    $date2=date_create($fin_loc);
    $diff=date_diff($date1,$date2);
    $duree = $diff->format("%a");

    echo "<tr><td>".$tri['prenom']."</td><td>".$tri['nom_client']."</td><td>".$tri['nom']."</td><td>".$date_debut."</td><td>".$date_fin."</td></tr>";
}
echo "</tr>";
echo "</tbody>";
echo "</table>";
}
    echo "</form>";
?>
</div>
<div class="bg-dark mt-5">
<!-- Footer -->
<footer class="page-footer font-small bg-dark lighten-3">

  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="https://mdbootstrap.com/education/bootstrap/">Paul Girard</a>
  </div>
  <!-- Copyright -->

</footer>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>


















