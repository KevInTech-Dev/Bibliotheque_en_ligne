<?php

//Gestion des erreurs
error_reporting(0);
ini_set("display_errors", 0);

//Configuration pour se connecter à la base de données
$DB_DSN = 'mysql:host=localhost;dbname=`biblio_iaec`';
$DB_USER = 'root';
$DB_PASS = '0083Reed#';

//Connexion à la base
try
{
    $options = 
    [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', //Création ou Initialisation de l'intance de la pdo
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //le mode d'erreur de la pdo
    ];

    $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $options);
    echo 'Connexion établie !';
}
catch(PDOException $pe)
{
    echo 'ERREUR : ' .$pe->getMessage();
}