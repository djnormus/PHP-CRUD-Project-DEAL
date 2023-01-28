<?php
// INCLUDE
require_once 'includes/init.include.php';
require_once 'includes/functions.php';

// // REDIRECTION SI MEMBRE DEJA CONNECTE
if (userConnected() == true) {
    header('location:profil.php');
}
// TITLE PAGE
$title = "inscription membres";

// INITIALISATION VARIABLES
$champsVide = '';
$pseudoExist = '';
$requete = '';

// RECUP SAISIES AVEC CONTROLE
if (isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['telephone']) && isset($_POST['email']) && isset($_POST['civilite'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['mdp']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['telephone']) && !empty($_POST['email'])) {
        $pseudo = trim($_POST['pseudo']);
        $pseudoVerif = $pdo->prepare("SELECT pseudo FROM membre WHERE pseudo = :pseudo");
        $pseudoVerif->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $pseudoVerif->execute();
        $verif_db = $pseudoVerif->fetch(PDO::FETCH_ASSOC);
        // VERIF PSEUDO EXISTANT
        if ($verif_db == true) {
            $pseudoExist = '<div class="alert alert-danger" role="alert">
            Le pseudo existe déjà, veuillez choisir un autre
          </div>'; // ALERT PSEUDO EXISTANT
        } else {

            $nom = trim($_POST['nom']);
            $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
            $prenom = trim($_POST['prenom']);
            $telephone = trim($_POST['telephone']);
            $email = trim($_POST['email']);
            $civilite = $_POST['civilite'];


            $requete = $pdo->prepare("INSERT INTO membre (id_membre, pseudo, mdp, nom, prenom, telephone, email, civilite, statut, date_enregistrement) VALUES (NULL, :pseudo, :mdp, :nom, :prenom, :telephone, :email, :civilite, 0, NOW())");
            $requete->bindParam(':pseudo', htmlspecialchars($pseudo), PDO::PARAM_STR);
            $requete->bindParam(':mdp', htmlspecialchars($mdp), PDO::PARAM_STR);
            $requete->bindParam(':nom', htmlspecialchars($nom), PDO::PARAM_STR);
            $requete->bindParam(':prenom', htmlspecialchars($prenom), PDO::PARAM_STR);
            $requete->bindParam(':telephone', htmlspecialchars($telephone), PDO::PARAM_STR);
            $requete->bindParam(':email', htmlspecialchars($email), PDO::PARAM_STR);
            $requete->bindParam(':civilite', $civilite, PDO::PARAM_STR);
            $requete->execute();

            // Pour éviter de renvoyer le même enregistrement en rechargeant la page, on va rediriger avec PHP sur cette page après l'enregistrement pour perdre les données dans $_POST
            header('location:connexion_membres.php');
        }
    } else {
        $champsVide = '<div class="alert alert-danger" role="alert">
        Champ vide
        </div>';
    }
}

// INCLUDE HEAD + NAVBAR
require_once 'includes/top.incl.php'
?>


<h1 class="text-center mt-5">Formulaire d'inscription</h1>
<!-- FORMULAIRE D'INSCRIPTION -->
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 mx-auto">
            <form method="POST" class=" bg-light border border-secondary rounded mt-5 p-3 mb-5" enctype="multipart/form-data" action="">
                <!-- MESSAGE ALERT -->
                <?php echo $pseudoExist; ?>
                <?php echo $champsVide; ?>
                <div class="mb-3">
                    <label for="pseudo" class="form-label">Pseudo :</label>

                    <input type="text" class="form-control" id="pseudo" name="pseudo" autofocus>
                </div>

                <div class="mb-3 ">
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
                    <label for="prenom" class="form-label">Prenom :</i></label> <!--         MEMORISATION DES SAISIES -->
                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?php if (isset($_POST["prenom"])) {
                                                                                                    echo $_POST["prenom"];
                                                                                                }  ?>">
                </div>

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom :</i></label> <!--         MEMORISATION DES SAISIES -->
                    <input type="text" class="form-control" id="nom" name="nom" value="<?php if (isset($_POST["nom"])) {
                                                                                            echo $_POST["nom"];
                                                                                        }  ?>">
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone :</label> <!--         MEMORISATION DES SAISIES -->
                    <input type="tel" class="form-control" id="telephone" name="telephone" value="<?php if (isset($_POST["telephone"])) {
                                                                                                        echo $_POST["telephone"];
                                                                                                    }  ?>">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label> <!--         MEMORISATION DES SAISIES -->
                    <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($_POST["email"])) {
                                                                                                echo $_POST["email"];
                                                                                            }  ?>">
                </div>

                <!-- CIVILITE -->
                <label for="sexe" class="form-label">Sexe</label>
                <div class="mb-4">
                    <div class=" form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="civilite" id="sex" value="m">
                        <label class="form-check-label" for="inlineRadio1">M</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="civilite" checked id="sex" value="f">
                        <label class="form-check-label" for="inlineRadio2">F</label>
                    </div>
                </div>

                <div class="mb-3">

                    <input type="submit" class="btn btn-primary w-100 " value="Inscription">
                </div>
            </form>
        </div>
    </div>
</div>


<!-- INCLUDE FOOTER -->
<?php require_once 'includes/footer.incl.php' ?>