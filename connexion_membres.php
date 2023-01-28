<?php
require_once 'includes/init.include.php';
require_once 'includes/functions.php';
// // REDIRECTION SI MEMBRE DEJA CONNECTE
if (userConnected()== true){
    header('location:profil.php');
}
$title = 'Connexion membres';

// INITIALISATION DES VARIABLES
$msgDeconnect = '';
$msgMdpEmpty = '';
$msgMdpError = '';
$msgConnectOk = '';
// 
if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
    $msgDeconnect = '<div class="alert alert-success" role="alert">
Vous êtes déconnecté </div>';
}

$requete = '';
// RECUP DES SAISIES
if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
        $pseudo = htmlspecialchars(trim($_POST['pseudo']));
        $mdp = htmlspecialchars(trim($_POST['mdp']));


        $requete = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
        $requete->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $requete->execute();
        $profil = $requete->fetch(PDO::FETCH_ASSOC);


        // Test pour savoir si la requête nous as retourné un resultat
        if ($profil == true) {

            // On affecte le pseudo et le mdp à une variable
            $pseudo_bdd = $profil['pseudo'];
            $mdp_bdd = $profil['mdp'];

            // VERIF MDP - UTILISATEUR ET BDD
            if (password_verify($mdp, $mdp_bdd)) {

                $msgConnectOk = '<div class="alert alert-success" role="alert">
                Bienvenue ! ' . $pseudo . '
                </div>'; // ALERT CONNEXION REUSSI

                foreach ($profil as $titre => $info) {
                    $_SESSION[$titre] = $profil[$titre];
                }
            }

            header('location:profil.php');
        } else {
            $msgMdpError = '<div class="alert alert-danger" role="alert">
            Le pseudo ou le mot de passe est incorrect
          </div>'; // ALERT MDP INCORRECT
        }
    } else {
        $msgMdpEmpty =  '<div class="alert alert-danger" role="alert">
                Le champ pseudo ou mot de passe est vide
              </div>'; // ALERT MDP VIDE
    }
}


?>

<!-- Include Head + Navbar -->
<?php require_once 'includes/top.incl.php' ?>

<h1 class="text-center mt-5">Connexion</h1>

<div class="container">
    <div class="row">

        <div class="col-12 col-md-6 mx-auto">
            <form method="POST" class="bg-light border border-secondary rounded mt-5 p-3" enctype="multipart/form-data" action="">
                <!-- MESSAGES -->
                <?php echo $msgMdpEmpty; ?>
                <?php echo $msgDeconnect; ?>
                <?php echo $msgMdpError; ?>
                <?php echo $msgConnectOk; ?>

                <div class="mb-3">
                    <label for="pseudo" class="form-label">Pseudo :</i></label>
                    <input type="text" class="form-control" id="pseudo" name="pseudo" autofocus>
                </div>

                <div class="mb-4">
                    <div class="col-auto">
                        <label for="mdp" class="col-form-label">Mot de passe :</label>
                    </div>
                    <div class="col-auto">
                        <input type="password" id="mdp" name="mdp" class="form-control" aria-describedby="password">
                    </div>
                    <div class="col-auto">
                        <span id="password" name="mdp" class="form-text">
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    
                    <input type="submit" class="btn btn-primary w-100" name="connexion" value="Connexion">

                </div>
            </form>
        </div>
    </div>
</div>


<!-- TEST FORMULAIRE -->
<!-- **************** -->
<section class="login-clean">
        <form method="post">
            <h2 class="visually-hidden">Connexion</h2>
            <div class="illustration"><i class="icon ion-log-in"></i></div>
            <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Mot de passe"></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Connexion</button></div><a class="forgot" href="#">Vous n'avez pas de compte? <br>Inscrivez-vous.</a>
        </form>
    </section>

<!-- **************** -->
<!-- INCLUDE FOOTER -->



<!-- Include Head + Navbar -->
<?php require_once 'includes/footer.incl.php' ?>