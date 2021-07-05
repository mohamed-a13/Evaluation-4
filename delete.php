<?php

  $title = "Delete";

  include "includes/connect.php";

  $idClient = strip_tags($_GET["id"]);

  $deleteClient = "DELETE FROM clients WHERE idClient=:idClient";
  $req1 = $pdo->prepare($deleteClient);
  $req1->bindValue(":idClient", $idClient, PDO::PARAM_INT);
  $req1->execute();

  $deleteResa = "DELETE FROM reservations WHERE idClient=:idClient";
  $req2 = $pdo->prepare($deleteResa);
  $req2->bindValue(":idClient", $idClient, PDO::PARAM_INT);
  $req2->execute();

  header("Location: admin.php");

?>