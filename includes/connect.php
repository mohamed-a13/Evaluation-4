<?php

  $server = "localhost";
  $dbname = "cinestudi";
  $login = "root";
  $password = "";

  try {

    //On se connecte à la base de données
    $pdo = new PDO("mysql:host=$server;dbname=$dbname", $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //On définit le charset à "UTF8"
    $pdo->exec("SET NAMES utf8");

    //On récupère la méthode de récupération des données (fetch)
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }
  catch (PDOException $e) {
    die("Erreur: " . $e->getMessage());
  }

?>