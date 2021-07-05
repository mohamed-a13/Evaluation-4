<?php

//On démarre la session PHP
session_start();

$title = "Liste des films";

include "includes/header.php";

include "includes/nav.php";

include "includes/connect.php";

//On récupère l'id et son age du client
$idClient = $_SESSION["client"]["id"];

//On vérifie si le formulaie a été envoyé
if(!empty($_POST)) {
  //Le formulaire a été envoyé
  //On vérifie que tous les champs ne sont pas vides
  if(isset($_POST["titre"], $_POST["dateSeance"], $_POST["horaire"], $_POST["place"]) 
  && !empty($_POST["titre"]) && !empty($_POST["dateSeance"]) && !empty($_POST["horaire"]) && !empty($_POST["place"])) {

    //Le formulaire est complet
    //On protege les données contre les attaques XSS
    $titre = strip_tags($_POST["titre"]);
    $dureeFilm = 0;
    $img = "";
    if($titre === "Tom et Jerry") {
      $dureeFilm = 120;
      $img = "tometjerry";
    } else if ($titre === "Tempête de boulettes géantes") {
      $dureeFilm = 130;
      $img = "tempete";
    } else if ($titre === "Monstres et compagnies") {
      $dureeFilm = 150;
      $img = "monstres";
    } else {
      echo "Error";
    }

    $descriptif = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
    $dateSeance = strip_tags($_POST["dateSeance"]);
    $horaire = strip_tags($_POST["horaire"]);
    $place = strip_tags($_POST["place"]);
    //On détermine le tarif du client
    $tarif = 5 * $place;

    if($horaire === "10h00") {
      $horaire === '[\"10h00\"]';
    } else if($horaire === "20h00") {
      $horaire === '[\"20h00\"]';
    } else {
      die("erreur");
    }

    //Ajouter ici tout les controles souhaités


    $sql = "INSERT INTO reservations(idClient, titre, img, descriptif, dateSeance, tarif, dureeFilm, place, horaire) 
                            VALUES(:idClient, :titre, :img, :descriptif, :dateSeance, :tarif, :dureeFilm, :place, :horaire)";

    $requete = $pdo->prepare($sql);

    $requete->bindValue(":idClient", $idClient, PDO::PARAM_INT);
    $requete->bindValue(":titre", $titre, PDO::PARAM_STR);
    $requete->bindValue(":img", $img, PDO::PARAM_STR);
    $requete->bindValue(":descriptif", $descriptif, PDO::PARAM_STR);
    $requete->bindValue(":dateSeance", $dateSeance, PDO::PARAM_STR);
    $requete->bindValue(":tarif", $tarif, PDO::PARAM_STR);
    $requete->bindValue(":dureeFilm", $dureeFilm, PDO::PARAM_INT);
    $requete->bindValue(":place", $place, PDO::PARAM_INT);
    $requete->bindValue(":horaire", $horaire, PDO::PARAM_STR);

    $requete->execute();

    header("Location: reservations.php");

  }


}


?>

<div class="container carousel1">

<div class="row">

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <a href="<?php if(!isset($_SESSION["client"])) {
        echo "connexion.php";
      } else {
        echo "profil.php";
      } ?>" name="image"><img src="img/tometjerry.jpg" class="d-block w-100" alt="Affiche de Tom et Jerry"></a>
      <div class="carousel-caption d-none d-md-block">
        <h5>Tom et Jerry</h5>
      </div>
    </div>
    <div class="carousel-item">
      <a href="<?php if(!isset($_SESSION["client"])) {
        echo "connexion.php";
      } else {
        echo "profil.php";
      } ?>"><img src="img/tempete.jpg" class="d-block w-100" alt="Affiche de tempête de boulettes géantes"></a>
      <div class="carousel-caption d-none d-md-block">
        <h5>Tempête de boulettes géantes</h5>
      </div>
    </div>
    <div class="carousel-item">
      <a href="<?php if(!isset($_SESSION["client"])) {
        echo "connexion.php";
      } else {
        echo "profil.php";
      } ?>"><img src="img/monstres.jpg" class="d-block w-100" alt="Affiche de monstres et compagnies"></a>
      <div class="carousel-caption d-none d-md-block">
        <h5>Monstres et compagnies</h5>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Precedent</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Suivant</span>
  </button>
</div>

</div>

</div>

<div class="container">

  <div class="row">
  
  <form method="POST">
  <div class="mb-3">
    <label for="disabledSelect" class="form-label">Selectionner votre film</label>
    <select name="titre" id="disabledSelect" class="form-select">
      <option value="Tom et Jerry">Tom et Jerry</option>
      <option value="Tempête de boulettes géantes">Tempête de boulettes géantes</option>
      <option value="Monstres et compagnies">Monstres et compagnies</option>
    </select>
  </div>
  <div class="mb-3">
    <label for="example-date-input" class="col-2 col-form-label">Sélectionner la date</label>
    <div class="col-10">
      <input name="dateSeance" class="form-control" type="date" value="<?= date('Y-m-d'); ?>" min="<?= date('Y-m-d'); ?>" max="2030-12-21" id="example-date-input">
    </div>
  </div>
  <div class="mb-3">
    <label for="disabledSelect" class="form-label">Sélectionner l'horaire</label>
    <select name="horaire" id="disabledSelect" class="form-select">
      <option value="10h00">10h00</option>
      <option value="20h00">20h00</option>
    </select>
  </div>
  <div class="mb-3">
    <label for="disabledSelect" class="form-label">Selectionner le nombre de place</label>
    <select name="place" id="disabledSelect" class="form-select">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Réservez</button>
</form>
  
  </div>

<?php

include_once "includes/footer.php";

?>


