<?php
session_start();
// DEBUT DE SESSION

// CONNEXION BDD DISTANT
// $host = 'mysql:host=localhost;dbname=madleos';
// $login = 'admin_mdls'; // login
// $password = 'Xpot99@@'; // mdp
// $options = array(
//     PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
//     PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
// );
// $pdo = new PDO($host, $login, $password, $options);
// // CHEMIN D'ACCES RACINE SITE
// define('PATH', "/");



// CONNEXION BDD LOCAL
$host = 'mysql:host=localhost;dbname=deal';
$login = 'root'; // login
$password = 'root'; // mdp
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
);
$pdo = new PDO($host, $login, $password, $options);

// CHEMIN D'ACCES RACINE SITE
define('PATH', "http://localhost:8888/");