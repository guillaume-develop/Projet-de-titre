<?php
require_once 'inc/bdd.php';


// $produits=afficher($myDb);
$produits = [];
// Requete d'affichage des poduits
// Si il y a des donnéees dans mydb, je fait une requete d'affichage que je stock dans une variable recup 
if (!empty($myDb)) {
    $recup = $myDb->prepare("
    SELECT produits.*, editeur.nom as editeur_nom, plateforme.nom as plateforme_nom, genre.nom as genre_nom
    FROM produits 
    LEFT JOIN editeur ON editeur.id_editeur = produits.id_editeur 
    LEFT JOIN genre ON genre.id_genre = produits.id_genre 
    LEFT JOIN plateforme ON plateforme.id_plateforme = produits.id_plateforme
    ORDER BY id_produit DESC 
    ");

    $recup->execute();

    //je deploie la requete de ma variable recup que je stock dans mon tableau produits
    $produits = $recup->fetchAll(PDO::FETCH_OBJ);

    // debug($produits);
}





require_once 'composants/header.php';
?>
<!-- Slider -->

<div id="top" class=" d-flex justify-content-center text-center text-uppercase">
    <h2 class="titre2 mt-3">Top des ventes</h2>
</div>

<?php include_once 'composants/carousel.php'; ?>

<?php include_once 'composants/search.php'; ?>
<section class="middle">



    <!-- Une div par produit -->
    <!-- // Pour chaque produit, je cree un nouveau bloc -->


    <?php foreach ($produits as $unProduit) : ?>
        <a class="product-container mb-2 ms-2" href="/ps2.html">
            <div class="">
                <img class="product" src="<?= $unProduit->image ?>" alt="" width="304px" height="267,7px">
                <h4 class="d-flex ms-2"><?= substr($unProduit->nom, 0, 40); ?></h4>
                <span class="">Plateforme: <?= substr($unProduit->plateforme_nom, 0, 200); ?></span><br>
                <span class="2">Genre: <?= substr($unProduit->genre_nom, 0, 200); ?></span><br>
                <span class="2">Editeur: <?= substr($unProduit->editeur_nom, 0, 200); ?></span>
                <hr>

                <div class="d-flex ms-2 mb-2 justify-centent-space-between">

                    <button type="button" class=" btn btn-sm btn-outline-success">Acheter</button>


                    <small class="text-muted"><?= $unProduit->prix ?> €</small>

                </div>
            </div>
        </a>
    <?php endforeach; ?>

</section>

<?php
require_once 'composants/footer.php';


?>