<?php



$profil = $requete->fetch(PDO::FETCH_ASSOC);
    // var_dump($profil);

    // Test pour savoir si la requête nous as retourné un resultat
    if ($profil == true) {
        // On affecte le pseudo et le mdp à une variable
        $pseudo_bdd = $profil['pseudo'];
        $mdp_bdd = $profil['mdp'];

        // Test pour savoir si on a du contenu dans le pseudo et le mdp de la BDD
        if (!empty($pseudo_bdd) && !empty($mdp_bdd)) {
            if (($pseudo == $pseudo_bdd) && ($mdp == $mdp_bdd)) {
                echo '<div class="alert alert-success" role="alert">
            Bienvenue ! ' . $pseudo . '
            </div>';
                foreach ($profil as $titre => $info) {
                    $_SESSION[$titre] = $profil[$titre];
                }
                //header('location:profil.php');
            }
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">
        Le pseudo ou le mot de passe est incorrect
      </div>';
    }


    if (password_verify($mdp, $mdp_bdd)) {
        
    } else {
        echo '<div class="alert alert-danger" role="alert">
        Le pseudo ou le mot de passe est incorrect
      </div>';
    }
?>

    <?php if (userConnected() == false) {
        echo '<a href="connexion_membres.php" class="nav-link">Connexion</a>';
    } ?>
    
    <?php if (userConnected() == true) {
        echo '<a href="deconnexion.php" class="nav-link">Déconnexion</a>';
    }else {
        echo '<a href="connexion_membres.php" class="nav-link">Connexion</a>';
    }?>

<?php
                    if(internauteEstConnecteEtEstAdmin())
                    {
                        echo '<a href="' . RACINE_SITE . 'admin/gestion_membre.php">Gestion des membres</a>';
                        echo '<a href="' . RACINE_SITE . 'admin/gestion_commande.php">Gestion des commandes</a>';
                        echo '<a href="' . RACINE_SITE . 'admin/gestion_boutique.php">Gestion de la boutique</a>';
                    }
                    if(internauteEstConnecte())
                    {
                        echo '<a href="' . RACINE_SITE . 'profil.php">Voir votre profil</a>';
                        echo '<a href="' . RACINE_SITE . 'boutique.php">Accès à la boutique</a>';
                        echo '<a href="' . RACINE_SITE . 'panier.php">Voir votre panier</a>';
                        echo '<a href="' . RACINE_SITE . 'connexion.php?action=deconnexion">Se déconnecter</a>';
                    }
                    else
                    {
                        echo '<a href="' . RACINE_SITE . 'inscription.php">Inscription</a>';
                        echo '<a href="' . RACINE_SITE . 'connexion.php">Connexion</a>';
                        echo '<a href="' . RACINE_SITE . 'boutique.php">Accès à la boutique</a>';
                        echo '<a href="' . RACINE_SITE . 'panier.php">Voir votre panier</a>';
                    }
                    ?>