<?php

session_start();

//Création de la connexion avec ma base de données
$myDb = new PDO(
    // je crée chemin , id, mdp pour la connexion
    'mysql:host=localhost;dbname=retrogaming_shop',
    'root',
    '',
    array(
        //recuperation et affichage des erreurs
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    )
);



define('RACINE_SITE', $_SERVER['DOCUMENT_ROOT'] . '/Mon-projet-de-titre-test/');
define('URL', 'http://localhost/Mon-projet-de-titre-test/');

//inclusion des foncitons
require_once 'fonctions.php';
