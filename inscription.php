<?php
require_once 'inc/bdd.php';

// var_dump($_POST);
//je verifie le formulaire
if ($_POST) {
    // debug($_POST);

    $error="";


    if (empty($_POST['pseudo'])) {
        $errorPseudo = "<span class='font-italic text-danger'>*Veuillez entrer un pseudo.</span>";
        $error = true;
    }
    $isExist = $myDb->prepare("SELECT * FROM client WHERE pseudo= ?");
    $isExist->execute(array($_POST['pseudo']));
    $isExist->fetchAll(PDO::FETCH_ASSOC);
    if ($isExist->rowCount() >= 1) {
        $pseudoExist = "<span class='font-italic text-danger'>*Ce pseudo existe déjà.</span>";
        $error = true;
    }

    if (empty($_POST['nom'])) {
        $errorNom = "<span class='font-italic text-danger'>*Veuillez entrer votre nom.</span>";
        $error = true;
    }
    if (empty($_POST['prenom'])) {
        $errorPrenom = "<span class='font-italic text-danger'>*Veuillez entrer votre prenom.</span>";
        $error = true;
    }
    if (empty($_POST['adresse'])) {
        $errorAdresse = "<span class='font-italic text-danger'>*Veuillez entrer votre adresse.</span>";
        $error = true;
    }
    if (iconv_strlen($_POST['adresse']) >= 1 && iconv_strlen($_POST['adresse']) > 20) {
        $errorAdresseLenth = "<span class='font-italic text-danger'>*Adresse non conforme.</span>";
        $error = true;
    }
    if (empty($_POST['ville'])) {
        $errorVille = "<span class='font-italic text-danger'>*Veuillez renseigner votre ville.</span>";
        $error = true;
    }
    if (is_numeric($_POST['ville'])) {
        $errorFormatLetter = "<span class='font-italic text-danger'>*Veuillez écrire en toutes lettres.</span>";
        $error = true;
    }
    if (empty($_POST['cp'])) {
        $errorCp = "<span class='font-italic text-danger'>*Veuillez entrer votre code postal.</span>";
        $error = true;
    } elseif (!is_numeric($_POST['cp']) || iconv_strlen($_POST['cp']) !== 5) {
        $errorCp = "<span class='font-italic text-danger'>*Format invalide.</span>";
        $error = true;
    }
    if (empty($_POST['tel'])) {
        $errorTel = "<span class='font-italic text-danger'>*Veuillez entrer votre numero de téléphone.</span>";
        $error = true;
    } elseif (!is_numeric($_POST['tel']) || iconv_strlen($_POST['tel']) !== 10) {
        $errorFormatTel = "<span class='font-italic text-danger'>*Format invalide.</span>";
        $error = true;
    }

    if (empty($_POST['email'])) {
        $errorMail = "<span class='font-italic text-danger'>*Veuillez renseigner votre adresse email.</span>";
        $error = true;
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errorFormatMail = "<span class='font-italic text-danger'>*Format email invalide (ex:exemple@gmail.com).</span>";
        $error = true;
    }

    $isExist = $myDb->prepare("SELECT * FROM client WHERE email = ?");
    $isExist->execute(array($_POST['email']));
    $isExist->fetchAll(PDO::FETCH_ASSOC);
    if ($isExist->rowCount() >= 1) {
        $errorEmailExist = "<span class='font-italic text-danger'>*Cette adresse email existe déjà.</span>";
        $error = true;
    }

    if (iconv_strlen($_POST['mdp']) < 8) {
        $errorMdpLenght = "<span class='font-italic text-danger'>*Votre mot de passe doit comporter au moins 8 caractères.</span>";
        $error = true;
    } elseif ($_POST['mdp'] != $_POST['confirmMdp']) {
        $errorMdp = "<span class='font-italic text-danger'>*Les mots de passe ne correspondent pas.</span>";
        $error = true;
    }



    if ($error != true) {
        foreach ($_POST as $indice => $valeur) {
            $_POST[$indice] = htmlentities($valeur, ENT_QUOTES);
            $_POST[$indice] = addslashes($valeur);
        }

        $photo_bdd = '';

        if (!empty($_FILES['photo']['name'])) {
            $nom_photo = $_POST['pseudo'] . '_' . $_FILES['photo']['name'];
            $photo_bdd = URL . "assets/photo/$nom_photo";
            $photo_dossier = RACINE_SITE . "assets/photo/$nom_photo";
            copy($_FILES['photo']['tmp_name'], $photo_dossier);
        }

        $validation = "<div class='m-2 alert alert-success'>Votre inscription est validée.</div>";
        $hashMdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
        $dateSub = date("Y-m-d H:i:s");

        $query=$myDb->prepare("INSERT INTO client (pseudo,nom,prenom,civilite,adresse,ville,cp,telephone,photo,email,mdp,date_enregistrement) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

        $query->bindParam(1, $_POST['pseudo']);
        $query->bindParam(2, $_POST['nom']);
        $query->bindParam(3, $_POST['prenom']);
        $query->bindParam(4, $_POST['civilite']);
        $query->bindParam(5, $_POST['adresse']);
        $query->bindParam(6, $_POST['ville']);
        $query->bindParam(7, $_POST['cp'], PDO::PARAM_INT);
        $query->bindParam(8, $_POST['tel'], PDO::PARAM_INT);
        $query->bindParam(9, $photo_bdd);
        $query->bindParam(10, $_POST['email']);
        $query->bindParam(11, $hashMdp);
        $query->bindParam(12, $dateSub, PDO::PARAM_INT);

        $query->execute();

        header('location: inscription.php');
    }
}

require_once 'composants/header.php';
?>

<h2 class="text-center mt-4">Inscription</h2>

<div class="container">
    
    <form class="mx-auto col-md-5" id="form" method="POST" enctype="multipart/form-data">
        <?php if (isset($validation)) echo $validation . "<br>" ?>


        <label for="pseudo">*Pseudo</label>
        <input type="text" id="pseudo" name="pseudo" class="form-control" placeholder="Entrez votre pseudo">
        <p id="errorPseudo" style="color: red;"></p>
        <?php if (isset($errorPseudo)) echo $errorPseudo . "<br>" ?>

        <label for="nom">*Nom</label>
        <input type="text" id="nom" name="nom" class="form-control" placeholder="Entrez votre nom">
        <p id="errorName" style="color: red;"></p>
        <?php if (isset($errorNom)) echo $errorNom . "<br>" ?>


        <label for="prenom">*Prenom</label>
        <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Entrez votre prenom">
        <p id="errorFirstName" style="color: red;"></p>
        <?php if (isset($errorPrenom)) echo $errorPrenom . "<br>" ?>

        <label for="civilite">*Civilite</label>
        <select name="civilite" id="civilite" class="form-control">
            <option value="h">Homme</option>
            <option value="f">Femme</option>
        </select>

        <label for="adresse">*adresse</label>
        <input type="text" id="adresse" name="adresse" class="form-control" placeholder="Entrez votre nom et numero de rue">
        <p id="errorAdress" style="color: red;"></p>
        <?php if (isset($errorAdresse)) echo $errorAdresse . "<br>"  ?>
        <?php if (isset($errorAdresseLenth)) echo $errorAdresseLenth . "<br>"  ?>

        <label for="ville">*Ville</label>
        <input type="text" id="ville" name="ville" class="form-control" placeholder="Entrez le nom de votre ville">
        <p id="errorTown" style="color: red;"></p>
        <?php if (isset($errorVille)) echo $errorVille . "<br>" ?>
        <?php if (isset($errorFormat)) echo $errorFormatLetter . "<br>" ?>

        <label for="code postal">*Code Postal</label>
        <input type="text" id="cp" name="cp" class="form-control" placeholder="indiquez votre code postal">
        <p id="errorCp" style="color: red;"></p>
        <?php if (isset($errorCp)) echo $errorCp . "<br>" ?>

        <label for="telephone">Téléphone</label>
        <input type="text" id="tel" name="tel" class="form-control" placeholder="indiquez votre numéro de téléphone">
        <p id="errorPhone" style="color: red;"></p>
        <?php if (isset($errorTel)) echo $errorTel . "<br>" ?>
        <?php if (isset($errorFormatTel)) echo $errorFormatTel . "<br>" ?>

        <label for="photo">Photo (facultatif)</label>
        <input type="file" name="photo" class="form-control">

        <label for="mail">*E-mail</label>
        <input type="text" id="email" name="email" class="form-control" placeholder="Entrez votre adresse e-mail">
        <p id="errorMail" style="color: red;"></p>
        <?php if (isset($errorMail)) echo $errorMail . "<br>" ?>
        <?php if (isset($errorFormatMail)) echo $errorFormatMail . "<br>" ?>

        <label for="password">*Mot de passe</label>
        <input type="text" id="mdp" name="mdp" class="form-control" placeholder="Entrez votre mot de passe. 8 caractère minimum.">
        <p id="errorPassword" style="color: red;"></p>
        <?php if (isset($errorMdpLenght)) echo $errorMdpLenght . "<br>" ?>
        <?php if (isset($errorMdp)) echo $errorMdp . "<br>" ?>

        <label for="password">*Confirmation du mot de passe</label>
        <input type="text" id="confirmMdp" name="confirmMdp" class="form-control" placeholder="Veuillez confirmer votre mot de passe">
        <p id="errorConfirmPassword" style="color: red;"></p>
        <?php if (isset($errorMdp)) echo $errorMdp . "<br>" ?><br>

        <button type="submit" name="suscrib" class="btnconnexion  rounded-3 p-2 text-light mb-5">S'inscrire</button>






    </form>
</div>


<?php
require_once 'composants/footer.php';


?>