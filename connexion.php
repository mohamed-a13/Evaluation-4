<?php

  //j'ouvre une session
session_start();


//si le variable session existe deja on me réoriente automatiquement sur la page profil sans que je rentre mon identifiant et mon pass
if(isset($_SESSION["client"])) {
  header("Location: profil.php");
  exit;
}

//sinon quand je rentre mon identifiant
if(!empty($_POST)) {
    //Le formulaire a été envoyé
    //On vérifie que tous les champs ne sont pas vides
    if(isset($_POST["mail"], $_POST["mdp"]) && !empty($_POST["mail"]) && !empty($_POST["mdp"])) {

        $_SESSION["error"] = [];

        //on vérifie l'email
        $mail = $_POST["mail"];

        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        //on vérifie l'ortographe de l'email 
        $_SESSION["error"][] = "L'adresse mail est incorrect";
    }

    //On se connecte à la base de données
    include_once "includes/connect.php";

    $sql = "SELECT * FROM clients WHERE mail = :mail";
    $requete = $pdo->prepare($sql);
    $requete->bindValue(":mail", $mail, PDO::PARAM_STR);
    $requete->execute();
    $client = $requete->fetch();

    //si le mail n'est pas déja enregistré dans la base de donné
    if(!$client) {

      $_SESSION["error"][] = "L'utilisateur et/ou le mot de passe n'existe pas";

    }else{ //sinon si le mail est dans la base db

        //on verifi le mdp

        if(!password_verify($_POST["mdp"], $client["mdp"])) {
            $_SESSION["error"][] = "L'utilisateur et/ou le mot de passe n'existe pas";
          } else { // le mot de pass et bon alors on redirige et on stock les infos

            $_SESSION["client"] = [
                "id" => $client["idClient"],
                "nom" => $client["nom"],
                "prenom" => $client["prenom"],
                "role" => $client["role"],
                "mail" => $client["mail"],
              ];

            header("Location: profil.php");
            exit;

          }

    }
    
    //Ici on a un client existant, on peut vérifier le mot de passe

  
  }

}

  $title = "Connexion";

  include_once "includes/header.php";

  include_once "includes/nav.php";

?>

<!--***Formulaire de connexion***-->

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
    
      <h1>Connexion</h1>

      <form method="POST">
        
        <div class="mb-3">
          <label for="mail" class="form-label">Mail</label>
          <input type="email" class="form-control" id="mail" name="mail">
        </div>
        <div class="mb-3">
          <label for="mdp" class="form-label">Mot de passe</label>
          <input type="password" class="form-control" id="mdp" name="mdp">
        </div>
        <p>Vous n'avez de compte ? <a href="inscription.php">Veuillez créer un compte</a></p>
        <button type="submit" class="btn btn-primary">Se connecter</button>
      </form>
    
    </div>
  
  </div>

<?php

  include_once "includes/footer.php";

?>