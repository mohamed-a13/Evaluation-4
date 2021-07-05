<?php
  session_start();

  //Supprimer les variables
  unset($_SESSION["client"]);
  unset($_SESSION["resa"]);

  header("Location: index.php");

?>

