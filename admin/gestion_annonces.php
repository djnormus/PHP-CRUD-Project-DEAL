<?php

// TITLE PAGE
$title = 'Admin - Gestion des Annonces';

// INCLUDE INIT
require_once '../includes/init.include.php';

require_once '../includes/functions.php';
if (userAdmin() == true && userConnected() == true) {
} else {
    header('location:../connexion_membres.php');
}


// REQUETE SELECT MEMBRE
//$requete = $pdo->query("SELECT id_membre, pseudo, nom, prenom, telephone, email, civilite, statut, date_enregistrement FROM membre WHERE id_membre=$_GET[idMembre]");


// INCLUDE HEAD + NAVBAR
require_once '../includes/top.incl.php';

?>
<!-- TITRE H1 -->
<h1 class="text-center m-5">Gestion des Annonces</h1>





        <?php
                require_once '../includes/footer.incl.php';
        ?>