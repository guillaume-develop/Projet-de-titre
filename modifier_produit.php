<?php
require_once 'inc/bdd.php';

// Requete d'affichage des poduits
// Si il y a des donnéees dans mydb, je fait une requete d'affichage que je stock dans une variable recup 
if (isset($_GET['id'])) {
    $recup = $myDb->prepare("SELECT produits.*, editeur.nom as editeur_nom, plateforme.nom as plateforme_nom, genre.nom as genre_nom
    FROM produits 
    LEFT JOIN editeur ON editeur.id_editeur = produits.id_editeur 
    LEFT JOIN genre ON genre.id_genre = produits.id_genre 
    LEFT JOIN plateforme ON plateforme.id_plateforme = produits.id_plateforme 
    WHERE id_produit = '$_GET[id]'");

    $recup->execute();

    $produit = $recup->fetch(PDO::FETCH_OBJ);

    // if($produit->editeur_nom == 'nintendo'){
    //     $editeur_editeur = "selected";
    // }
    // else{
    //     $editeur_editeur = "";
    // }
}


//recuperation des editeurs
$editeurs = [];

//on récupére l'editeur ectuel !
$recup = $myDb->prepare("SELECT * FROM editeur");

$recup->execute();

$editeurs = $recup->fetchAll(PDO::FETCH_OBJ);

// if( $unEditeurs->nom == 'nintendo' )
// {
//     $editeur_nintendo = "selected";
// }
// else{
//     $editeur_nintendo = "";
// }

//recuperation des plateformes
$plateformes = [];

//on récupére l'editeur ectuel !
$recup = $myDb->prepare("SELECT * FROM plateforme");

$recup->execute();

$plateformes = $recup->fetchAll(PDO::FETCH_OBJ);

// if( $unEditeurs->nom == 'nintendo' )
// {
//     $editeur_nintendo = "selected";
// }
// else{
//     $editeur_nintendo = "";
// }

//recuperation des genres
$genres = [];

//on récupére l'editeur ectuel !
$recup = $myDb->prepare("SELECT * FROM genre");

$recup->execute();

$genres = $recup->fetchAll(PDO::FETCH_OBJ);

// if( $unEditeurs->nom == 'nintendo' )
// {
//     $editeur_nintendo = "selected";
// }
// else{
//     $editeur_nintendo = "";
// }


if ($_POST) {

    $error = "";

    if ($error != true) {
        foreach ($_POST as $indice => $valeur) {
            $_POST[$indice] = htmlentities($valeur, ENT_QUOTES);
            $_POST[$indice] = addslashes($valeur);
        }

        $photo_bdd = '';

        if (!empty($_FILES['image']['name'])) {
            $nom_photo = $_POST['nom'] . '_' . $_FILES['image']['name'];
            $photo_bdd = URL . "assets/images-produits/$nom_photo";
            $photo_dossier = RACINE_SITE . "assets/images-produits/$nom_photo";
            copy($_FILES['image']['tmp_name'], $photo_dossier);
        }
    }

    $query = $myDb->prepare("
    UPDATE produits.* 
    SET nom=?, prix=?, description=?, image=?, stock=?
    WHERE id_produit = ?");

    $query->bindParam(1, $_POST['nom']);
    $query->bindParam(2, $_POST['prix'], PDO::PARAM_INT);
    $query->bindParam(3, $_POST['description']);
    $query->bindParam(4, $photo_bdd);
    $query->bindParam(5, $_POST['stock'], PDO::PARAM_INT);
    $query->bindParam(6, $_GET['id'], PDO::PARAM_INT);


    $query->execute();

    $queryEdit = $myDb->prepare("
    UPDATE produits.*
    JOIN produits ON produits.id_editeur = editeur.id_editeur
    SET editeur.nom = ?
    WHERE editeur.id_editeur = produits.id_editeur AND produits.id_produit = ? 
    ");


    $queryEdit->bindParam(1, $_POST['editeur']);
    $queryEdit->bindParam(2, $_GET['id'], PDO::PARAM_INT);

    $queryEdit->execute();
}



require_once 'composants/header.php';
?>

<h2 class="text-center mt-4">Modifier le produits</h2>

<?php if (isset($validation)) echo $validation . "<br>" ?>

<div class="container">

    <a class="btnconnexion  rounded-3 p-2 text-light mb-5 mt-5 text-decoration-none" href="espaceAdmin.php">Retour</a>
    <form class="mx-auto col-md-5" method="POST" enctype="multipart/form-data">



        <label for="nom">Nom</label>
        <input type="text" value="<?= $produit->nom ?>" name="nom" class="form-control" placeholder="Entrez un nom de produit">


        <label for="price">*Prix</label>
        <input type="float" value="<?= $produit->prix ?>" name="prix" class="form-control" placeholder="Entrez votre un prix">


        <label for="editeur">Editeur</label>
        <select name="editeur" id="" class="form-control">
            <?php foreach ($editeurs as $unEditeur) : ?>
                <option value="<?= $produit->editeur_nom ?>"><?= $unEditeur->nom ?></option>
            <?php endforeach; ?>
        </select>

        <label for="plateforme">*Plateforme</label>
        <select name="plateforme" id="" class="form-control">
            <?php foreach ($plateformes as $unePlateforme) : ?>
                <option><?= $unePlateforme->nom ?></option>
            <?php endforeach; ?>
        </select>

        <label for="category">*Genre</label>
        <select name="genre" id="" class="form-control">
            <?php foreach ($genres as $unGenre) : ?>
                <option value=""><?= $unGenre->nom ?> </option>
            <?php endforeach; ?>
        </select>

        <label for="description">*description</label>
        <input type="textArea" value="<?= $produit->description ?>" name="description" class="form-control" placeholder="Entrez une description">

        <label for="ville">*Stock</label>
        <input type="number" value="<?= $produit->Stock ?>" name="stock" class="form-control" placeholder="Nb de produits en stock">



        <label for="photo">*image</label>
        <input type="file" value="<?= $produit->image ?>" name="image" class="form-control"><br>

        <img value="<?=$produit->image ?>" src="<?= $produit->image ?>" width="45%"><br>



        <button type="submit" name="ajouter" class="btnconnexion  rounded-3 p-2 text-light mb-5 mt-3">modifier</button>






    </form>
</div>













<?php
require_once 'composants/footer.php';


?>