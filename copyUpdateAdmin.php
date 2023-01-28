<?php
$id_membre = $_GET['idMembre'];
// TITLE PAGE
$title = 'Admin - Modification membre';

// INCLUDE INIT
require_once '../includes/init.include.php';
require_once '../includes/functions.php';
if (userAdmin()== true && userConnected()== true){
    
}else{
    header('location:../connexion_membres.php');
}
// INITIALISATION VARIABLES
$data = '';
$resultat = '';
$pseudoExist = '';
$requete = '';

// RECUP SAISIES AVEC CONTROLE
if (isset($_POST['pseudo']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['telephone']) && isset($_POST['email']) && isset($_POST['statut']) && isset($_POST['civilite'])) {
    $pseudo = htmlspecialchars (trim($_POST['pseudo']));
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

        $nom = htmlspecialchars(trim($_POST['nom']));
        $prenom = htmlspecialchars (trim($_POST['prenom']));
        $telephone = htmlspecialchars (trim($_POST['telephone']));
        $email = htmlspecialchars (trim($_POST['email']));
        $civilite = $_POST['civilite'];
        $statut = $_POST['statut'];

        
        $requete = $pdo->prepare("UPDATE membre SET pseudo = :pseudo, nom = :nom , prenom = :prenom , telephone = :telephone, email = :email, civilite = :civilite , statut = :statut WHERE id_membre = :id_membre ");
        $requete->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $requete->bindParam(':nom', $nom, PDO::PARAM_STR);
        $requete->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $requete->bindParam(':telephone', $telephone, PDO::PARAM_STR);
        $requete->bindParam(':email', $email, PDO::PARAM_STR);
        $requete->bindParam(':civilite', $civilite, PDO::PARAM_STR);
        $requete->bindParam(':statut', $statut, PDO::PARAM_STR);
        $requete->bindParam(':id_membre', $id_membre, PDO::PARAM_STR);
        $requete->execute();
        // Pour éviter de renvoyer le même enregistrement en rechargeant la page, on va rediriger avec PHP sur cette page après l'enregistrement pour perdre les données dans $_POST
        header('location:/admin/gestion_membres.php');
    }
}



// INCLUDE HEAD + NAVBAR
require_once '../includes/top.incl.php';

?>
<!-- TITRE H1 -->
<h1 class="text-center m-5">Modification des membres</h1>


        <!-- FORMULAIRE DDE MODIFICATION -->
        
        <div class="container">
        <h3 class="mt-5">Modifier membre :</h3>
            <div class="row">
                <div class="col-12 col-md-6 mx-auto">
                    <p> Vous êtes sur le point de modier le membre avec l'ID : <?php echo $verif_db["id_membre"]; ?> </p>
                    <form method="POST" class=" bg-light border border-secondary rounded mt-3 p-3 mb-5" enctype="multipart/form-data" action="">
                        <!-- MESSAGE ALERT -->
                        <?php echo $pseudoExist; ?>
                        <div class="mb-3">
                            <label for="pseudo" class="form-label">Pseudo :</label>

                            <input type="text" class="form-control" id="pseudo" name="pseudo" autofocus value="<?php echo $verif_db["pseudo"]; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prenom :</i></label> <!--         MEMORISATION DES SAISIES -->
                            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $verif_db["prenom"]; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom :</i></label> <!--         MEMORISATION DES SAISIES -->
                            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $verif_db["nom"]; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone :</label> <!--         MEMORISATION DES SAISIES -->
                            <input type="tel" class="form-control" id="telephone" name="telephone" value="<?php echo $verif_db["telephone"]; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email :</label> <!--         MEMORISATION DES SAISIES -->
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $verif_db["email"]; ?>">
                        </div>

                        <!-- CIVILITE -->
                        <label for="sexe" class="form-label">Sexe :<?php echo ' "Actuel : '.$verif_db["civilite"].'"'; ?></label>
                        <div class="mb-3">
                            <div class=" form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="civilite" id="civilite" value="m">
                                <label class="form-check-label" for="inlineRadio1">M</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="civilite" selected="selected" id="civilite" value="f">
                                <label class="form-check-label" for="inlineRadio2">F</label>
                            </div>
                        </div>

                        <!-- STATUT -->
                        <label for="statut" class="form-label">Statut :<?php echo ' "Actuel : '.$verif_db["statut"].'"'; ?></label>
                        <div class="mb-4">
                            <div class=" form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="statut" id="statut" value="1">
                                <label class="form-check-label" for="inlineRadio1">Admin</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="statut" selected="selected" id="statut" value="0">
                                <label class="form-check-label" for="inlineRadio2">Membre</label>
                            </div>
                        </div>

                        <div class="mb-3">

                            <input type="submit" class="btn btn-primary w-100" value="Modifier">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- INCLUDE FOOTER -->
        <?php require_once '../includes/footer.incl.php' ?>