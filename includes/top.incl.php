<?php
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../css/style.css">
    <!-- ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- Playfair display -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
    <!-- Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- titre de page dynamique PHP -->
    <title><?php echo $title; ?></title>
    
</head>

<body>
    <!-- class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4" -->
    <nav class="navbar navbar-expand-lg navbar-dark fw-lighter customnav">
        <div class="container">
            <a class="navbar-brand me-5" href="../index.php">DEAL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link active me-3" aria-current="page">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link active me-3" aria-current="page">Les annonces</i></a>
                    </li>
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link active me-3" aria-current="page">Catégories</i></a>
                    </li>
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link active me-3" aria-current="page">À propos</i></a>
                    </li>
                    <!-- ******* MODAL ******* -->


                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-user-circle fa-lg"></i></button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- ************** -->
                    <!-- MENU DEROULANT -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fas fa-user-circle fa-lg"></i></a>
                        <ul class="dropdown-menu">

                            <!-- CONDITIONS AFFICHAGE MENU NAVBAR INSCRIPTION -->
                            <li><?php if (userConnected() == false) {
                                    echo '<a href="' . PATH . 'inscription_membres.php" class="dropdown-item"><i class="fas fa-glass-cheers"></i> Inscription</a>';
                                } ?>
                            </li>

                            <!-- CONDITIONS AFFICHAGE MENU NAVBAR MON ESPACE-->
                            <li><?php if (userConnected() == true) {
                                    echo '<a href="' . PATH . 'profil.php" class="dropdown-item"><i class="fas fa-user-circle"></i> Mon profil</a>';
                                } ?>
                            </li>

                            <!-- CONDITIONS AFFICHAGE ADMIN GESTION MEMBRES-->
                            <li><?php if (userConnected() == true && userAdmin() == true) {
                                    echo '<a href="' . PATH . 'admin/gestion_membres.php" class="dropdown-item"><i class="fas fa-users-cog"></i> Gestion des membres</a>';
                                } ?>
                            </li>

                            <!-- CONDITIONS AFFICHAGE ADMIN GESTION CATEGORIES-->
                            <li><?php if (userConnected() == true && userAdmin() == true) {
                                    echo '<a href="' . PATH . 'admin/gestion_categories.php" class="dropdown-item"><i class="fas fa-sitemap"></i> Gestion des catégories</a>';
                                } ?>
                            </li>

                            <!-- CONDITIONS AFFICHAGE ADMIN GESTION ANNONCES-->
                            <li><?php if (userConnected() == true && userAdmin() == true) {
                                    echo '<a href="' . PATH . 'admin/gestion_annonces.php" class="dropdown-item"><i class="fas fa-bullhorn"></i> Gestion des annonces</a>';
                                } ?>
                            </li>

                            <!-- CONDITIONS AFFICHAGE ADMIN GESTION AVIS-->
                            <li><?php if (userConnected() == true && userAdmin() == true) {
                                    echo '<a href="' . PATH . 'admin/gestion_avis.php" class="dropdown-item"><i class="far fa-comments"></i> Gestion des avis</a>';
                                } ?>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- CONDITIONS AFFICHAGE MENU NAVBAR LOGIN LOGOUT-->
                            <li><?php if (userConnected() == true) {
                                    echo '<a href="' . PATH . 'deconnexion.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>';
                                } else {
                                    echo '<a href="' . PATH . 'connexion_membres.php" class="dropdown-item"><i class="fas fa-sign-in-alt"></i> Connexion</a>';
                                } ?>
                            </li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Recherche" aria-label="Search">
                    <button class="btn btn-outline-warning" type="submit">GO</button>
                </form>
            </div>
        </div>
    </nav>