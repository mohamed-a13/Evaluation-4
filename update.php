<?php

  session_start();

  $title = "Update";

  include_once "includes/header.php";

  include_once "includes/nav.php";

  include "includes/connect.php";

  $idClient = strip_tags($_GET["id"]);

  $modifClient = "SELECT * FROM clients WHERE idClient=:idClient";
  $req1 = $pdo->prepare($modifClient);
  $req1->bindValue(":idClient", $idClient, PDO::PARAM_INT);
  $req1->execute();
  $list = $req1->fetch();

  if($_POST) {

    $role = '[\"role_user\"]';
    $nom = strip_tags($_POST["nom"]);
    $prenom = strip_tags($_POST["prenom"]);
    $mail = $_POST["mail"];

    $_SESSION["error"] = [];

      if(strlen($nom) < 2) {
        $_SESSION["error"][] = "Le nom est trop court";
      } else if(strlen($nom) > 20) {
        $_SESSION["error"][] = "Le nom est trop long";
      }
      
      if(strlen($prenom) < 2) {
        $_SESSION["error"][] = "Le prenom est trop court";
      } else if(strlen($prenom) > 20) {
        $_SESSION["error"][] = "Le prenom est trop long";
      }

      if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"][] = "L'adresse mail est incorect";
      }

    $sql = "UPDATE clients SET nom = :nom, prenom = :prenom, mail = :mail, role = :role WHERE idClient = $idClient";

    $requete = $pdo->prepare($sql);

    $requete->bindValue(":nom", $nom, PDO::PARAM_STR);
    $requete->bindValue(":prenom", $prenom, PDO::PARAM_STR);
    $requete->bindValue("mail", $mail, PDO::PARAM_STR);
    $requete->bindValue(":role", $role, PDO::PARAM_STR);

    $requete->execute();

    header("Location: admin.php");

    }

?>


<div class="container mb-3">
  
    <div class="row">
      
    
      <h1>Modifier</h1>

      <form method="POST">
        <div class="mb-3">
          <label for="nom" class="form-label">Nom</label>
          <input type="text" class="form-control" id="nom" name="nom" value="<?= $list["nom"] ?>">
        </div>
        <div class="mb-3">
          <label for="prenom" class="form-label">Prenom</label>
          <input type="text" class="form-control" id="prenom" name="prenom"  value="<?= $list["prenom"] ?>">
        </div>
        <div class="mb-3">
          <label for="mail" class="form-label">Mail</label>
          <input type="email" class="form-control" id="mail" name="mail"  value="<?= $list["mail"] ?>">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
      </form>
    
    </div>
  
  </div>

<?php

  include_once "includes/footer.php";

?>