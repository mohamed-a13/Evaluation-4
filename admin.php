<?php

  //On démarre la session PHP
  session_start();

  //Page pour l'administrateur pour creer, supprimer ou modifier des données
  if(($_SESSION["client"]["role"]) !== '[\"role_admin\", \"role_user\"]') {
    die("Cete page est réserver à l'administrateur" . ". " . "Retourner sur la page profil " . "<a href='profil.php'>cliquer ici</a>");
  }

  $title = "Admin";

  //On inclut le header
  include_once "includes/header.php";
  include_once "includes/nav.php";
  
  //On se connecte à la base
  require_once "includes/connect.php";

  $sql = "SELECT * FROM clients";
  $req = $pdo->query($sql);
  $clients = $req->fetchAll();

?>
  
  <div class="container">

    <div class="row">
    
      <h1 class="mt-3"><?php echo $_SESSION["client"]["nom"] . " " . $_SESSION["client"]["prenom"]; ?></h1>

    </div>

    <div class="row justify-content-center">

        <?php foreach($clients as $client){ ?>

          <div class="card m-3 bg-primary text-white" style="width: 18rem;">
            <div class="card-body">
              <p class="card-title">Identifiant n° <?= $client["idClient"] ?></p>
              <p class="card-text">Nom: <?= $client["nom"] ?></p>
              <p>Prenom: <?= $client["prenom"] ?></p>
              <p>mail: <?= $client["mail"] ?> min</p>
              <p>Role: <?= $client["role"] ?></p>
              <a href="update.php?id=<?= $client["idClient"] ?>" class="btn btn-warning mb-2 w-25"><i class="fas fa-pencil-alt"></i></a>
              <a href="delete.php?id=<?= $client["idClient"] ?>" class="btn btn-danger mb-2 w-25"><i class="far fa-trash-alt"></i></a>
            </div>
          </div>
  
        <?php } ?>

    </div>

  </div>

<?php

  include_once "includes/footer.php";

?>