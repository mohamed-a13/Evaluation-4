<?php

  //On démarre la session PHP
  session_start();

  if(isset($_SESSION["client"])) {
    header("Location: profil.php");
    exit();
  }

  //On vérifie si le formulaie a été envoyé
  if(!empty($_POST)) {

    //Le formulaire a été envoyé
    //On vérifie que tous les champs ne sont pas vides
    if(isset($_POST["nom"], $_POST["prenom"], $_POST["mail"], $_POST["mdp"]) 
    && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["mail"]) && !empty($_POST["mdp"])) {

      //Le formulaire est complet
      //On protege les données contre les attaques XSS
      $nom = strip_tags($_POST["nom"]);
      $prenom = strip_tags($_POST["prenom"]);
      $mail = $_POST["mail"];

      //On crée une session error
      $_SESSION["error"] = [];

      //On vérifie la longueur du nom
      if(strlen($nom) < 2) {
        $_SESSION["error"][] = "Le nom est trop court";
      } else if(strlen($nom) > 20) {
        $_SESSION["error"][] = "Le nom est trop long";
      }
      
      //On vérifie la longueur du nom
      if(strlen($prenom) < 2) {
        $_SESSION["error"][] = "Le prenom est trop court";
      } else if(strlen($prenom) > 20) {
        $_SESSION["error"][] = "Le prenom est trop long";
      }

      //On vérifie le format de l'adresse mail
      if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"][] = "L'adresse mail est incorrect";
      }

      //On enregistre en bdd
      require_once "includes/connect.php";

      //On vérifie si le mail est déjà existant
      $reqMail = "SELECT * FROM clients WHERE mail = :mail";
      $mailExist = $pdo->prepare($reqMail);
      $mailExist->bindValue(":mail", $mail, PDO::PARAM_STR);
      $mailExist->execute();
      $verifMail = $mailExist->fetch();

      if($mail === $verifMail["mail"]) {
        $_SESSION["error"][] = "Cette adresse mail est déjà utilisé";
      }

      function checkMdp($motDePasse) {
        
        $majuscule = preg_match('@[A-Z]@', $motDePasse);
        $minuscule = preg_match('@[a-z]@', $motDePasse);
        $chiffre = preg_match('@[0-9]@', $motDePasse);

        if(!$majuscule || !$minuscule || !$chiffre || strlen($motDePasse) < 8 || strlen($motDePasse) > 8)
          {
            $_SESSION["error"][] = "Le mot de passe doit être composer de 8 caractères et doit comporter au moins 1 majuscule, 1 miniscule et 1 chiffre ";
          }
            
      }

      checkMdp($_POST["mdp"]);

      if($_SESSION["error"] === []) {

      //On hashe le mot de passe
      $mdp = password_hash($_POST["mdp"], PASSWORD_BCRYPT);

      $role = '[\"role_user\"]';

      $sql = "INSERT INTO clients(role, nom, prenom, mail, mdp) 
      VALUES(:role, :nom, :prenom, :mail, '$mdp')";

      $requete = $pdo->prepare($sql);

      $requete->bindValue(":role", $role, PDO::PARAM_STR);
      $requete->bindValue(":nom", $nom, PDO::PARAM_STR);
      $requete->bindValue(":prenom", $prenom, PDO::PARAM_STR);
      $requete->bindValue(":mail", $mail, PDO::PARAM_STR);
      $requete->bindValue(":role", $role, PDO::PARAM_STR);

      $requete->execute();

      //On récupère l'id du client
      $idClient = $pdo->lastInsertId();

      //On connecte l'utilisateur

      //On stocke dans $_SESSION les informations de l'utilisateurs
      $_SESSION["client"] = [
        "id" => $idClient,
        "nom" => $nom,
        "prenom" => $prenom,
        "role" => $role,
        "mail" => $mail
      ];


    //On redirige vers la page de profil
    header("Location: profil.php");
    
  }
    } else {

      $_SESSION["error"] = ["Le formulaire est incomplet"];

    }

  }

  $title = "Inscription";

  include_once "includes/header.php";

  include_once "includes/nav.php";

?>

<div class="container mb-3">
  
    <div class="row">

        <?php 
          if(isset($_SESSION["error"])) {
            foreach($_SESSION["error"] as $message) { ?>
              
              <?= "<h6 class='mt-2 text-danger'>$message</h6>" ?>

          <?php  }
            unset($_SESSION["error"]);
          }
        ?>
      
    
      <h1>Inscription</h1>

      <form method="POST">
        <div class="mb-3">
          <label for="nom" class="form-label">Nom</label>
          <input type="text" class="form-control" id="nom" name="nom">
        </div>
        <div class="mb-3">
          <label for="prenom" class="form-label">Prenom</label>
          <input type="text" class="form-control" id="prenom" name="prenom">
        </div>
        <div class="mb-3">
          <label for="mail" class="form-label">Mail</label>
          <input type="email" class="form-control" id="mail" name="mail">
        </div>
        <div class="mb-3">
          <label for="mdp" class="form-label">Mot de passe</label>
          <input type="password" class="form-control" id="mdp" name="mdp">
        </div>
        <button type="submit" class="btn btn-primary">M'inscrire</button>
      </form>
    
    </div>
  
  </div>

<?php

  include_once "includes/footer.php";

?>