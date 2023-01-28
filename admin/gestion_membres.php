<?php
// TITLE PAGE
$title = 'Admin - Gestion des membres';

// INCLUDE INIT
require_once '../includes/init.include.php';
require_once '../includes/functions.php';
if (userAdmin() == true && userConnected() == true) {
} else {
    header('location:../connexion_membres.php');
}
// INITIALISATION VARIABLES
$data = '';
$resultat = '';
$pseudoExist = '';
$requete = '';

// RECUP SAISIES AVEC CONTROLE
if (isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['telephone']) && isset($_POST['email']) && isset($_POST['statut']) && isset($_POST['civilite'])) {
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
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
        $mdp = htmlspecialchars(password_hash($_POST['mdp'], PASSWORD_DEFAULT));
        $prenom = htmlspecialchars(trim($_POST['prenom']));
        $telephone = htmlspecialchars(trim($_POST['telephone']));
        $email = htmlspecialchars(trim($_POST['email']));
        $civilite = $_POST['civilite'];
        $statut = $_POST['statut'];


        $requete = $pdo->prepare("INSERT INTO membre (id_membre, pseudo, mdp, nom, prenom, telephone, email, civilite, statut, date_enregistrement  ) VALUES (NULL, :pseudo, :mdp, :nom, :prenom, :telephone, :email, :civilite, :statut, CURDATE())");
        $requete->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $requete->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        $requete->bindParam(':nom', $nom, PDO::PARAM_STR);
        $requete->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $requete->bindParam(':telephone', $telephone, PDO::PARAM_STR);
        $requete->bindParam(':email', $email, PDO::PARAM_STR);
        $requete->bindParam(':civilite', $civilite, PDO::PARAM_STR);
        $requete->bindParam(':statut', $statut, PDO::PARAM_STR);
        $requete->execute();

        // Pour éviter de renvoyer le même enregistrement en rechargeant la page, on va rediriger avec PHP sur cette page après l'enregistrement pour perdre les données dans $_POST
        header('location:/admin/gestion_membres.php');
    }
}
$resultat = $pdo->query("SELECT id_membre, pseudo, nom, prenom, telephone, email, civilite, statut, date_enregistrement FROM membre");
// INCLUDE HEAD + NAVBAR
require_once '../includes/top.incl.php'
?>
<!-- TITRE H1 -->
<h1 class="text-center m-5">Gestion des membres</h1>

<!-- ******* AFFICHAGE DES MEMBRES -->

<div class="col-10 col-md-10 mx-auto table-responsive">
    <h3 class="mt-5">Liste des membres :</h3>
    <table class="table table-hover table-sm">
        <thead class="thead-light">
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
                <th scope="col">Action</th>

            </tr>
        </thead>

        <?php
        while ($data = $resultat->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            foreach ($data as $champ => $val) {
                if ($champ == 'date_enregistrement') {
                    echo '<td>' . $val . '</td>';
                    echo '<td><a href="view_membre.php?idMembre=' . $data["id_membre"] . '"><i class="btn fas fa-eye"></i></a>';
                    echo ' <a href="update_membre.php?idMembre=' . $data["id_membre"] . '"> <i class="btn fas fa-user-edit"></i></a>';
                    echo '<a href="delete_membre.php?idMembre=' . $data["id_membre"] . '"><i class="btn btn-danger fas fa-trash-alt"></i></a> </td>';
                } else {
                    echo '<td>' . $val . '</td>';
                }
            }
            echo '</tr>';
        }
        echo '</table> </div>';
        ?>



        <!-- FORMULAIRE D'INSCRIPTION -->

        <div class="container">
            <h3 class="mt-5">Ajout membre :</h3>
            <div class="row">
                <div class="col-12 col-md-6 mx-auto">
                    <form method="POST" class=" bg-light border border-secondary rounded mt-5 p-3 mb-5" enctype="multipart/form-data" action="">
                        <!-- MESSAGE ALERT -->
                        <?php echo $pseudoExist; ?>
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
                        <label for="sexe" class="form-label">Sexe :</label>
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
                        <label for="statut" class="form-label">Statut :</label>
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

                            <input type="submit" class="btn btn-primary w-100" value="Enregistrer">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- INCLUDE FOOTER -->
        <?php require_once '../includes/footer.incl.php' ?>