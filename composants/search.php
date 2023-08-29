<?php
require_once 'inc/bdd.php';



@$keywords = $_GET["recherche"];
@$valider = $_GET["valider"];

if (isset($valider) && !empty(trim($keywords))) {
    $res = $myDb->prepare("
        SELECT *
        FROM produits 
        WHERE nom LIKE '%$keywords%'");

    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();
    $filter = $res->fetchAll();
    $afficher = "oui";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Searchbar</title>
    <link rel="stylesheet" href="css/search.css">
</head>
<div class="row mt-5">
    <div class="col-md-5 mx-auto">
        <form action="" method="GET" class="d-flex">
            <input type="text" class="form-control" value="<?php echo $keywords ?>" placeholder="Recherche..." name="recherche">
            <button type="submit" class="search-btn mx-2" name='valider'>Rechercher</button>
        </form>
    </div>
    <?php if (@$afficher == "oui") { ?>
        
            <div id="nbr"><?=count($filter) ?></div>

            <section class="middle">

            <?php for($i=0;$i<count($filter);$i++) : ?>
                
                    <a class="product-container mb-2 ms-2" href="/ps2.html">
                        <div class="">
                            <img class="product" src="<?php echo $filter[$i]['image'] ?>" alt="" width="304px" height="267,7px">
                            <h4 class="d-flex ms-2"><?php echo $filter[$i]['nom'] ?></h4>
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
            <?php endfor; ?>

            </section>
            <hr>

        
</div>
<?php } ?>