<?php
$id_membre = $_GET['idMembre'];
// TITLE PAGE
$title = 'Admin - Affichage membre';

// INCLUDE INIT
require_once '../includes/init.include.php';

require_once '../includes/functions.php';
if (userAdmin() == true && userConnected() == true) {
} else {
    header('location:../connexion_membres.php');
}


// REQUETE SELECT MEMBRE
$requete = $pdo->query("SELECT id_membre, pseudo, nom, prenom, telephone, email, civilite, statut, date_enregistrement FROM membre WHERE id_membre=$_GET[idMembre]");


// INCLUDE HEAD + NAVBAR
require_once '../includes/top.incl.php';

?>
<!-- TITRE H1 -->
<h1 class="text-center m-5">Détail membre</h1>

<!-- AFFICHAGE DETAIL MEMBRE -->
<div class="container">
    <h3 class="mt-5">Détail du membre :</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Id membre</th>
                <th scope="col">Pseudo</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Téléphone</th>
                <th scope="col">E-mail</th>
                <th scope="col">Civilité</th>
                <th scope="col">Statut</th>
                <th scope="col">Date d'enregistrement</th>
            </tr>
        </thead>

        <?php
        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            foreach ($ligne as $val) {
                echo '<td>' . $val . '</td>';
            }
            echo '</tr>';
        }
        echo '</table></div>';








        require_once '../includes/footer.incl.php';
        ?>