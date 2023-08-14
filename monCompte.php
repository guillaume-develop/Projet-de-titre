<?php
require_once 'inc/bdd.php';


// debug( $_POST );
//récupération de l'id du membre connecté dans la session :
$id = $_SESSION['client']['id_client'];

//Modification:
if (isset($_POST['inscription'])) {

    $photo_bdd =$_POST['photo_actuelle'];

    if (!empty($_FILES['photo']['name'])) {
        $nom_photo = $_POST['pseudo'] . '_' . $_FILES['photo']['name'];
        $photo_bdd = URL . "assets/photo/$nom_photo";
        $photo_dossier = RACINE_SITE . "assets/photo/$nom_photo";
        copy($_FILES['photo']['tmp_name'], $photo_dossier);
    }

    $myDb->query("UPDATE client SET pseudo='$_POST[pseudo]', nom='$_POST[nom]', prenom='$_POST[prenom]',adresse='$_POST[adresse]', nom='$_POST[nom]', ville='$_POST[ville]',cp='$_POST[cp]', telephone='$_POST[tel]',photo='$photo_bdd' WHERE id_client='$id' ");
}


$result = $myDb->query("SELECT * FROM client WHERE id_client = " . $_SESSION['client']['id_client']);

$membreConnecte = $result->fetch(PDO::FETCH_ASSOC);
// debug( $membreConnecte );

require_once 'composants/header.php';

?>

<h2 class="text-center mt-4">Profil de <?php echo $membreConnecte['pseudo'] ?> </h2>

<section class="compte">

    <div class="d-flex justify-content-center mt-4">
        <img class="mypicture" src="<?php echo $membreConnecte['photo'] ?>">
    </div>
    <h3 class="fs-5 col-md-6 mx-auto mt-3">Mes informations</h3>
    <div class=" d-flex w-50 justify-content-space-between  mx-auto mt-1  border border-1 border-dark">
        <div class=" d-flex w-50 justify-content-start mx-auto  flex-column">

            <span class="ms-5"><strong>Pseudo :</strong> <?php echo $membreConnecte['pseudo'] ?></span>
            <span class="ms-5"><strong>Nom :</strong> <?php echo $membreConnecte['nom'] ?></span>
            <span class="ms-5"><strong>Prénom :</strong> <?php echo $membreConnecte['prenom'] ?></span>
            <span class="ms-5"><strong>Adresse :</strong> <?php echo $membreConnecte['adresse'] ?></span>

        </div>
        <div class="d-flex w-50 justify-content-start flex-column">


            <span class="ms-5"><strong>Ville :</strong> <?php echo $membreConnecte['ville'] ?></span>
            <span class="ms-5"><strong>Code postal :</strong> <?php echo $membreConnecte['cp'] ?></span>
            <span class="ms-5"><strong>E-mail :</strong> <?php echo $membreConnecte['email'] ?></span>
            <span class="ms-5"><strong>Téléphone :</strong> <?php echo $membreConnecte['telephone'] ?></span>

        </div>
    </div>

    <!-- bouton modal -->
    <div class=" col-md-6 mx-auto d-flex justify-content-end">
        <a class="gestion btn mt-3 text-light" data-bs-toggle="modal" data-bs-target="#exampleModal" href="monComte.php">Modifier</a>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">

                    <label class="fw-bold" for="pseudo">Pseudo</label>
                    <input type="text" name="pseudo" class="form-control" placeholder="Votre pseudo" value="<?= $membreConnecte['pseudo'] ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <label class="fw-bold" for="nom">Nom</label>
                            <input type="text" name="nom" class="form-control" placeholder="Votre nom" value="<?= $membreConnecte['nom'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold" for="prenom">Prenom</label>
                            <input type="text" name="prenom" class="form-control" placeholder="Votre prenom" value="<?= $membreConnecte['prenom'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold" for="email">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Votre email" value="<?= $membreConnecte['email'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold" for="tel">Téléphone</label>
                            <input type="int" name="tel" class="form-control" placeholder="Votre telephone" value="<?= $membreConnecte['telephone'] ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="fw-bold" for="adresse">Adresse</label>
                            <textarea name="adresse" class="form-control" placeholder="Votre adresse"><?= $membreConnecte['adresse'] ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold" for="ville">Ville</label>
                            <input type="text" name="ville" class="form-control" placeholder="Votre ville" value="<?= $membreConnecte['ville'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold" for="code_postal">Code postal</label>
                            <input type="text" name="cp" class="form-control" placeholder="Votre code postal" value="<?=$membreConnecte['cp'] ?>">
                        </div>

                    </div>
                    <label class="fw-bold" for="photo">Photo</label>
                    <input type="file" name="photo" class="form-control">
                    <div class="d-flex justify-content-center mt-4">
                        <img class="modal-picture" src="<?php echo $membreConnecte['photo'] ?>">
                    </div>
                    <input   type="hidden" name="photo_actuelle" value="<?= $membreConnecte['photo']?>">

                    
                    <input type="submit" name="inscription" class="btn btn-success mt-3">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>


<?php
require_once 'composants/footer.php';




?>