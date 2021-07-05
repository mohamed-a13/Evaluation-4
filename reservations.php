<?php

//On démarre la session PHP
session_start();

$title = "reservations";

include "includes/header.php";

include "includes/nav.php";

include "includes/connect.php";

//On vérifie si on a un id
if(!isset($_SESSION["client"]["id"]) || empty($_SESSION["client"]["id"])){
  //Je n'ai pas d'id
  header("Location: index.php");
  exit;
}

//Je récupère l'id du clients
$id = $_SESSION["client"]["id"];

$sql = "SELECT * FROM reservations WHERE idclient = $id";
$req = $pdo->query($sql);
$resa = $req->fetchAll();

$idResa = "";
if(isset($resa[0]["idResa"])) {
  $idResa = $resa[0]["idResa"];
}

//On stocke dans $_SESSION les informations de l'utilisateurs
$_SESSION["resa"] = [
  "idResa" => $idResa
];

//Supprimer les réservations passé
$delete = $pdo->prepare("DELETE from reservations where dateSeance < now() - interval 1 DAY");
$delete->execute();


?>

<div class="container">
    <div class="row justify-content-center">
        
      <h1 class="mt-3"><?php echo $_SESSION["client"]["nom"] . " " . $_SESSION["client"]["prenom"]; ?></h1>

<?php foreach($resa as $re){ ?>

  <div class="card m-3" style="width: 18rem;">
    <img src='img/<?= $re["img"] ?>.jpg' class='card-img-top img-fluid w-100 h-100' alt='...'>
    <div class="card-body">
      <p class="card-title">Réservation n° <?= $re["idResa"] ?></p>
      <p class="card-text">Titre: <?= $re["titre"] ?></p>
      <p>Descriptif: <?= $re["descriptif"] ?></p>
      <p>Duree: <?= $re["dureeFilm"] ?> min</p>
      <p>Nombre de place réservé: <?= $re["place"] ?></p>
      <p>Tarifs à régler: <?= $re["tarif"] ?> euros</p>
      <a href="#" class="btn btn-primary">Imprimer</a>
    </div>
  </div>
  
<?php } ?>
</div>
</div>
  </div>
<?php

include_once "includes/footer.php";

?>

