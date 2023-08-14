<?php 
require_once 'inc/bdd.php';

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

?>
<!DOCTYPE html>
<html>
<head>
  <title>Carousel de Cards avec Scroll-Snap</title>
  <link rel="stylesheet" href="css/carousel.css">
</head>

<div class="carousel-container">
  <div class="carousel">
  <?php foreach ($produits as $unProduit) : ?>
    <div class="card"><img class="carousel" src="<?= $unProduit->image ?>" alt="" cover></div>
    <?php endforeach ?>
    
  </div>
</div>

<script src="script.js"></script>

</body>
</html>
