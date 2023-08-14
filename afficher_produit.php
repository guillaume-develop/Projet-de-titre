<?php
require_once 'inc/bdd.php';


if (isset($_GET['id'])) {
    $recup = $myDb->prepare("SELECT produits.*, editeur.nom as editeur_nom, plateforme.nom as plateforme_nom, genre.nom as genre_nom
    FROM produits 
    LEFT JOIN editeur ON editeur.id_editeur = produits.id_editeur 
    LEFT JOIN genre ON genre.id_genre = produits.id_genre 
    LEFT JOIN plateforme ON plateforme.id_plateforme = produits.id_plateforme 
    WHERE id_produit = '$_GET[id]'");

    $recup->execute();

    $produit = $recup->fetch(PDO::FETCH_OBJ);

    
}









require_once 'composants/header.php';
?>

<div class="row-col-md-10 mx-auto mt-5">
    <h2 class="text-center"><?= $produit->nom ?></h2>
    <a class="ms-5 btnconnexion  rounded-3 p-2 text-light mb-5 mt-3 text-decoration-none" href="espaceAdmin.php">Retour</a>

    <div class="d-flex justify-content-center mt-4">
        <img class="" width="250px" src="<?= $produit->image ?>">
    </div>
    <div class="col-md-10 mt-4 mx-auto">
        <ul class="col-6  list-unstyled d-flex justify-content-around mx-auto">
            <li class="fw-bold">Plateforme: <a href="#" class="text-info p-0"><?= $produit->plateforme_nom ?></a></li>
            <li class="fw-bold">Editeur: <a href="#" class="text-danger p-0"><?= $produit->editeur_nom ?></a></li>
            <li class="fw-bold">Genre: <a href="#" class="text-success p-0"><?= $produit->genre_nom ?></a></li>
        </ul>

        <p class="mt-5 col-6 mx-auto border border-1 p-3 mb-5"><?= $produit->description ?></p>




    </div>
</div>






<?php
require_once 'composants/footer.php';


?>