<?php
// INCLUDE 
require_once 'includes/init.include.php';

// DETRUIRE LA SESSION
session_destroy();
// REDIRECTION
header('location:../connexion_membres.php?action=deconnexion'); 

// INCLUDE 
require_once 'includes/top.incl.php';

// TITLE PAGE
$title = 'Deconnexion';

// INCLUDE FOOTER
require_once 'includes/footer.incl.php';
