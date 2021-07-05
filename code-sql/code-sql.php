<?php
//Code SQL

/*
Création de la base de données
  $sql = "CREATE DATABASE cinestudi";
  $pdo->exec($sql);
*/

/*
Création de la table clients
$sql = "CREATE TABLE Clients(
                        Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        Nom VARCHAR(50) NOT NULL,
                        Prenom VARCHAR(50) NOT NULL,
                        mail VARCHAR(50) NOT NULL,
                        mdp VARCHAR(250) NOT NULL,
                        role VARCHAR(50) NOT NULL)";
$pdo->exec($sql);
*/

/*
Création de la table reservationq
$sql = "CREATE TABLE Clients(
                        idResa (100) INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        idClient INT(11) NOT NULL,
                        dateCreationResa TIMESTAMP CURRENT_TIME NOT NULL,
                        titre VARCHAR(45) NOT NULL,
                        img VARCHAR(100) NOT NULL,
                        descriptif TEXT NOT NULL,
                        dateSeance DATE NOT NULL,
                        tarif INT(11) NOT NULL,
                        dureeFilm INT(11) NOT NULL,
                        place INT(11) NOT NULL,
                        horaire VARCHAR(45) NOT NULL)";
$pdo->exec($sql);
*/






















?>