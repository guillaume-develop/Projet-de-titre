<?php
require_once 'inc/bdd.php';





// var_dump($_POST);
//je verifie le formulaire
if (isset($_POST['ajouter'])) {


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

    $validation = "<div class='m-4 w-50 mx-auto alert alert-success'>Votre produit est bien ajouté.</div>";

    $dateSub = date("Y-m-d H:i:s");

    $query = $myDb->prepare("INSERT INTO produits (nom, prix, description, image, stock, id_plateforme, id_genre, id_editeur) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Liage des paramètres
    $query->bindParam(1, $_POST['nom']);
    $query->bindParam(2, $_POST['prix'], PDO::PARAM_INT);
    $query->bindParam(3, $_POST['description']);
    $query->bindParam(4, $photo_bdd);
    $query->bindParam(5, $_POST['stock']);
    $query->bindParam(6, $_POST['plateforme']);
    $query->bindParam(7, $_POST['genre']);
    $query->bindParam(8, $_POST['editeur']);

    // Exécution de la requête
    $query->execute();


    header('ajouter_produit.php');
}
//recuperation des genres

$recup = $myDb->prepare("SELECT * FROM genre");

$recup->execute();

$genres = $recup->fetchAll(PDO::FETCH_OBJ);

//recuperation des editeurs
$recup = $myDb->prepare("SELECT * FROM editeur");

$recup->execute();

$editeurs = $recup->fetchAll(PDO::FETCH_OBJ);

//recuperation des plateformes
$recup = $myDb->prepare("SELECT * FROM plateforme");

$recup->execute();

$plateformes = $recup->fetchAll(PDO::FETCH_OBJ);




require_once 'composants/header.php';
?>

<h2 class="text-center mt-4">Ajout de produits</h2>

<?php if (isset($validation)) echo $validation . "<br>" ?>

<div class="container">

    <a class="btnconnexion  rounded-3 p-2 text-light mb-5 mt-5 text-decoration-none" href="espaceAdmin.php">Retour</a>
    <form class="mx-auto col-md-5" method="POST" enctype="multipart/form-data">



        <label for="nom">Nom</label>
        <input type="text" name="nom" class="form-control" placeholder="Entrez un nom de produit">


        <label for="price">*Prix</label>
        <input type="float" name="prix" class="form-control" placeholder="Entrez votre un prix">


        <label for="editeur">Editeur</label>
        <select name="editeur" id="" class="form-control">
            <?php foreach ($editeurs as $unEditeur) : ?>
                <option value="<?= $unEditeur->id_editeur ?>"><?= $unEditeur->nom ?></option>
            <?php endforeach; ?>
        </select>

        <label for="plateforme">*Plateforme</label>
        <select name="plateforme" id="" class="form-control">
            <?php foreach ($plateformes as $unePlateforme) : ?>
                <option value="<?= $unePlateforme->id_plateforme ?>"><?= $unePlateforme->nom ?></option>
            <?php endforeach; ?>
        </select>

        <label for="category">*Genre</label>
        <select name="genre" id="" class="form-control">
            <?php foreach ($genres as $unGenre) : ?>

                <option value="<?= $unGenre->id_genre ?>"><?= $unGenre->nom ?></option>
            <?php endforeach; ?>
        </select>

        <label for="description">*description</label>
        <input type="textArea" name="description" class="form-control" placeholder="Entrez une description">

        <label for="ville">*Stock</label>
        <input type="text" name="stock" class="form-control" placeholder="Nb de produits en stock">



        <label for="photo">*image</label>
        <input type="file" name="image" class="form-control">



        <button type="submit" name="ajouter" class="btnconnexion  rounded-3 p-2 text-light mb-5 mt-3">ajouter</button>






    </form>
</div>


<?php
require_once 'composants/footer.php';


?>