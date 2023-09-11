<?php

require_once 'inc/bdd.php';

if (isset($_POST['ajout_panier'])) {
    $r = $myDb->prepare("SELECT * FROM produits WHERE id_produit = '$_POST[id_produit]' ");
    $r->execute();
    $ajoutProd = $r->fetch(PDO::FETCH_ASSOC);
    debug($ajoutProd);

    ajout_panier($ajoutProd['id_produit'], $ajoutProd['nom'], $ajoutProd['prix'], $ajoutProd['image']);
}

$result = $myDb->prepare("
SELECT * 
FROM client 
WHERE id_client = " . $_SESSION['client']['id_client']);

$result->execute();



$membreConnecte = $result->fetch(PDO::FETCH_ASSOC);
// debug( $membreConnecte );
require_once 'composants/header.php';
?>

<h2 class="text-center mt-4">Panier de <?php echo $membreConnecte['pseudo'] ?> </h2>



<section class="middle">


<?php

if(creation_panier()) {
    $nbArticles = count($_SESSION['panier']['id_produit']);
    if ($nbArticles <= 0) {
        $messageVide = '<div><p class="color-danger">Votre panier est vide</p></div>';
        // debug($_SESSION);
    } else {
        for ($i = 0; $i < $nbArticles; $i++) {

            echo '<form class="middle" method="post">';
            echo '<div class="product-container mb-2 ms-2">';
            echo '<a class="text-decoration-none text-dark" href="/ps2.html">';
            echo '<div>';
            echo '<img class="product" src="' . $_SESSION['panier']['image'][$i] . '" alt="" width="100%" height="267.7px">';
            echo "<h4 class='d-flex color-dark'>" . $_SESSION['panier']['nom'][$i] . "</h4>";
            echo '</div>';
            echo '</a>';
            echo '<hr>';
            echo '<div class="d-flex ms-2 me-2 mb-2 justify-content-between">';
            echo '<button type="submit" action="supprimer" value="supprimer" class="ajoutPanier btn btn-m border border-2 text-white mb-2 rounded-3">Supprimer</button>'; // La balise <button> doit avoir un attribut "name" pour pouvoir être traitée côté serveur.
            echo '</div>';
            echo '</div>';
            echo '</form>';


        }


    }
}
?>
</section>'
    <!-- Une div par produit -->
    <!-- // Pour chaque produit, je cree un nouveau bloc -->

    




<?php

require_once 'composants/footer.php'
?>