<?php
// TITLE DE LA PAGE
$title = "Profil";

// INCLUDE 
require_once 'includes/init.include.php';
require_once 'includes/top.incl.php';
require_once 'includes/functions.php';
if (userConnected()== false){
    header('location:connexion_membres.php');
}

// AFFICHAGE DU PROFL SI SESSION ACTIVE SINON REDIRECTION
// if(isset($_SESSION['pseudo'])){

// }else{
//     // REDIRECTION SI SESSION NON ACTIVE
//     header('location:connexion_membres.php');
// }

?>
<!-- AFFICHAGE DU PROFIL -->
<h1 class="text-center mt-5">Mon profil</h1>

<div class="col-10 col-md-4 mx-auto table-responsive">
<p>Bonjour <?php echo $_SESSION["prenom"];?>, voici le détail de votre profil :</p>
    <table class="table table-hover table-sm">
        <tbody>
            <tr>
                <th>Pseudo :</th>
                <td><?php if(isset($_SESSION["pseudo"]))
                {echo $_SESSION["pseudo"];}  ?></td>
            </tr>
            <tr>
                <th>Nom :</th>
                <td><?php if(isset($_SESSION["nom"]))
                {echo $_SESSION["nom"];}  ?></td>
            </tr>
            <tr>
                <th>Prenom :</th>
                <td><?php if(isset($_SESSION["prenom"]))
                {echo $_SESSION["prenom"];}  ?></td>
            </tr>
            <tr>
                <th>Téléphone :</th>
                <td><?php if(isset($_SESSION["telephone"]))
                {echo $_SESSION["telephone"];}  ?></td>
            </tr>
            <tr>
                <th>E-mail :</th>
                <td><?php if(isset($_SESSION["email"]))
                {echo $_SESSION["email"];}  ?></td>
            </tr>
            <tr>
                <th>Civilité :</th>
                <td><?php if(isset($_SESSION["civilite"]))
                {echo $_SESSION["civilite"];}  ?></td>
            </tr>
            <tr>
                <th>Date d'enregistrement :</th>
                <td><?php if(isset($_SESSION["date_enregistrement"]))
                {echo $_SESSION["date_enregistrement"];}  ?></td>
            </tr>
        </tbody>
    </table>
</div>


<!-- INCLUDE FOOTER -->
<?php require_once 'includes/footer.incl.php' ?>



