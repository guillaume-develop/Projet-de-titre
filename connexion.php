<?php
require_once 'inc/bdd.php';

if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {

    session_destroy();
    header('location:index.php');
}

// debug($_SESSION);
// debug($_POST);
if ($_POST) {

    $isExist = $myDb->query("SELECT * FROM client WHERE email = '$_POST[mail]'");


    if ($isExist->rowCount() >= 1) {

        $client = $isExist->fetch(PDO::FETCH_ASSOC);
        debug($client);

        if (password_verify($_POST['mdp'], $client['mdp'])) {

            $_SESSION['client']['id_client'] = $client['id_client'];
            $_SESSION['client']['pseudo'] = $client['pseudo'];
            $_SESSION['client']['nom'] = $client['nom'];
            $_SESSION['client']['prenom'] = $client['prenom'];
            $_SESSION['client']['civilite'] = $client['civilite'];
            $_SESSION['client']['adresse'] = $client['adresse'];
            $_SESSION['client']['ville'] = $client['ville'];
            $_SESSION['client']['cp'] = $client['cp'];
            $_SESSION['client']['telephone'] = $client['telephone'];
            $_SESSION['client']['photo'] = $client['photo'];
            $_SESSION['client']['email'] = $client['email'];
            $_SESSION['client']['mdp'] = $client['mdp'];
            $_SESSION['client']['statut'] = $client['statut'];
            $_SESSION['client']['enregistrement'] = $client['date_enregistrement'];

            if ($client['statut'] == 1) {
                header("location:espaceAdmin.php");
            } else {
                header("location:index.php");
            }
        } else {
            $errorMdp = "<span class='font-italic text-danger'>*Mot de passe incorrect.</span>";
        }
    } else {
        $errorMail = "<span class='font-italic text-danger'>*L'adresse e-mail n'existe pas'.</span>";
    }
}

require_once 'composants/header.php';
?>



<h2 class="text-center mt-4">Connexion</h2>

<div class="container">

    <form class="mx-auto col-md-5" method="POST" name="formulaire">

        <label for="mail">*E-mail</label>
        <input type="text" name="mail" class="form-control" placeholder="Entrez votre adresse e-mail">
        <?php if (isset($errorMail)) echo $errorMail . "<br>"; ?>

        <label for="password">*Mot de passe</label>
        <input type="password" name="mdp" class="form-control" placeholder="Entrez votre mot de passe"><br>
        <?php if (isset($errorMdp)) echo $errorMdp . "<br>"; ?>

        <button type="submit" name="submit" class="btnconnexion rounded-3 p-2 text-light">Se connecter</button>






    </form>
</div>


<?php
require_once 'composants/footer.php';

?>