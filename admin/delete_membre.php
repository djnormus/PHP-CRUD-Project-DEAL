<?php
$id_membre = $_GET['idMembre'];
// TITLE PAGE
$title = 'Admin - Suppression membre';

// INCLUDE INIT
require_once '../includes/init.include.php';

require_once '../includes/functions.php';
if (userAdmin() == true && userConnected() == true) {
} else {
    header('location:../connexion_membres.php');
}


// REQUETE DE SUPPRESSION MEMBRE
$pdo->query("DELETE FROM membre WHERE id_membre=$_GET[idMembre]");

// REDIRECTION
header('location:/admin/gestion_membres.php');


// INCLUDE HEAD + NAVBAR
require_once '../includes/top.incl.php';
require_once '../includes/footer.incl.php';
