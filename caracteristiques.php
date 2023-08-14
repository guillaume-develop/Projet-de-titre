<?php
require_once 'inc/bdd.php';

//suppression des editeurs
if (isset($_GET['id'])) {
    $myDb->query("DELETE FROM editeur WHERE id_editeur='$_GET[id]'");
    

    $supEditeur = "<div class='m-4 w-50 mx-auto alert alert-success '>Le libellé est bien supprimé.</div>";

    
}

//ajouter des editeurs
//Nom du post correspondant au nom du submit souhaité pour que ça fontionne(Si multi-formulaires)
if (isset($_POST['submit_editeur'])) {

    $myDb->query("INSERT INTO editeur (nom) VALUES('$_POST[nom]')");

    $ajout= "<div class='m-4 w-50 mx-auto alert alert-success'>L'éditeur est bien ajouté.</div>";
    
    header("Location:caracteristiques.php");
    
}
//affichage des editeurs

$editeurs = [];

if (isset($myDb)) {
    $recupEditeurs = $myDb->prepare('SELECT * FROM editeur');

    $recupEditeurs->execute();

    $editeurs = $recupEditeurs->fetchAll(PDO::FETCH_OBJ);
}
//suppression des plateformes
if (isset($_GET['id'])) {
    $myDb->query("DELETE FROM plateforme WHERE id_plateforme='$_GET[id]'");

    $supPlateforme = "<div class='m-4 w-50 mx-auto alert alert-success'>La plateforme est bien supprimé.</div>";
}

//ajouter des plateformes

if (isset($_POST['submit_plateforme'])) {

    $myDb->query("INSERT INTO plateforme (nom) VALUES('$_POST[nom]')");

    $ajout= "<div class='m-4 w-50 mx-auto alert alert-success'>La plateforme est bien ajoutée.</div>";

    header("Location:caracteristiques.php");
}
//affichage des plateformes

$plateformes = [];

if (isset($myDb)) {
    $recupPlateforme = $myDb->prepare('SELECT * FROM plateforme');

    $recupPlateforme->execute();

    $plateformes = $recupPlateforme->fetchAll(PDO::FETCH_OBJ);
}

//suppression des genres
if (isset($_GET['id'])) {
    $myDb->query("DELETE FROM genre WHERE id_genre='$_GET[id]'");

    $supGenre = "<div class='m-4 w-50 mx-auto alert alert-success'>Le genre est bien supprimé.</div>";
}

//ajouter des genres

if (isset($_POST['submit_genre'])) {

    $myDb->query("INSERT INTO genre (nom) VALUES('$_POST[nom]')");
    $ajout= "<div class='m-4 w-50 mx-auto alert alert-success'>Le genre est bien ajouté.</div>";

    header("Location:caracteristiques.php");
}
//affichage des genres

$genres = [];

if (isset($myDb)) {
    $recupGenre = $myDb->prepare('SELECT * FROM genre');

    $recupGenre->execute();

    $genres = $recupGenre->fetchAll(PDO::FETCH_OBJ);
}








require_once 'composants/header.php';


?>


<h2 class="col-md-5 mx-auto mt-4">Gestion des caractéristiques produits</h2>


<?php if (isset($supEditeur)) echo $supEditeur . "<br>" ?>
<?php if (isset($ajout)) echo $ajout . "<br>" ?>

<a class="ms-5 btnconnexion  rounded-3 p-2 text-light mb-5 mt-3 text-decoration-none" href="espaceAdmin.php">Retour</a>

<section class="d-flex row-col-md-10 justify-content-around mt-5">


    <!--Editeur-->

    <div class="w-25">

        <table class="table border border-1 mt-2 text-center text-align-center ">

            <thead class="bg-dark text-white">

                <tr>
                    <th class="col-3">Editeurs</th>
                    <th class="col-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- //pour chaque produit de ma table produits, je créé une nouvelle ligne dans mon tableau pour l'afficher -->
                <?php foreach ($editeurs as $editeur) : ?>
                    <tr>
                        <td><?= $editeur->nom ?></td>

                        <td class=" border-start border-1"><a href="caracteristiques.php?id=<?= $editeur->id_editeur; ?>" onclick="return confirm(' Attention, cet éditeur sera définitivement supprimé')"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="20px" height="20px">
                                    <path d="M 28 6 C 25.791 6 24 7.791 24 10 L 24 12 L 23.599609 12 L 10 14 L 10 17 L 54 17 L 54 14 L 40.400391 12 L 40 12 L 40 10 C 40 7.791 38.209 6 36 6 L 28 6 z M 28 10 L 36 10 L 36 12 L 28 12 L 28 10 z M 12 19 L 14.701172 52.322266 C 14.869172 54.399266 16.605453 56 18.689453 56 L 45.3125 56 C 47.3965 56 49.129828 54.401219 49.298828 52.324219 L 51.923828 20 L 12 19 z M 20 26 C 21.105 26 22 26.895 22 28 L 22 51 L 19 51 L 18 28 C 18 26.895 18.895 26 20 26 z M 32 26 C 33.657 26 35 27.343 35 29 L 35 51 L 29 51 L 29 29 C 29 27.343 30.343 26 32 26 z M 44 26 C 45.105 26 46 26.895 46 28 L 45 51 L 42 51 L 42 28 C 42 26.895 42.895 26 44 26 z" />
                                </svg></a></td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
        <form class="mt-3" method="POST" name="formulaire">

            <label for="text">Ajouter un éditeur</label>
            <input type="text" name="nom" class="form-control" placeholder="Entrez un nom d'éditeur">

            <button type="submit" name="submit_editeur" class="btnconnexion  rounded-3 p-2 text-light mb-5 mt-3">Ajouter</button>

        </form>
    </div>

    <!--Plateforme-->
    <div class="w-25">
        <table class="table border border-1 mt-2 text-center text-align-center ">

            <thead class="bg-dark text-white">

                <tr>
                    <th class="col-3">Plateforme</th>
                    <th class="col-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- //pour chaque produit de ma table produits, je créé une nouvelle ligne dans mon tableau pour l'afficher -->
                <?php foreach ($plateformes as $plateforme) : ?>
                    <tr>
                        <td><?= $plateforme->nom ?></td>

                        <td class=" border-start  border-1"><a href="caracteristiques.php?id=<?= $plateforme->id_plateforme ?>" onclick="return confirm(' Attention, cette plateforme sera définitivement supprimé')"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="20px" height="20px">
                                    <path d="M 28 6 C 25.791 6 24 7.791 24 10 L 24 12 L 23.599609 12 L 10 14 L 10 17 L 54 17 L 54 14 L 40.400391 12 L 40 12 L 40 10 C 40 7.791 38.209 6 36 6 L 28 6 z M 28 10 L 36 10 L 36 12 L 28 12 L 28 10 z M 12 19 L 14.701172 52.322266 C 14.869172 54.399266 16.605453 56 18.689453 56 L 45.3125 56 C 47.3965 56 49.129828 54.401219 49.298828 52.324219 L 51.923828 20 L 12 19 z M 20 26 C 21.105 26 22 26.895 22 28 L 22 51 L 19 51 L 18 28 C 18 26.895 18.895 26 20 26 z M 32 26 C 33.657 26 35 27.343 35 29 L 35 51 L 29 51 L 29 29 C 29 27.343 30.343 26 32 26 z M 44 26 C 45.105 26 46 26.895 46 28 L 45 51 L 42 51 L 42 28 C 42 26.895 42.895 26 44 26 z" />
                                </svg></a></td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
        <form method="POST" name="formulaire">

            <label for="text">Ajoutez un plateforme</label>
            <input type="text" name="nom" class="form-control" placeholder="Entrez un nom de plateforme">

            <button type="submit" name="submit_plateforme" class="btnconnexion  rounded-3 p-2 text-light mb-5 mt-3">Ajouter</button>
        </form>
    </div>

    <!--Genre-->
    <div class="w-25">
        <table class="table border border-1 mt-2 text-center text-align-center ">

            <thead class="bg-dark text-white">

                <tr>
                    <th class="col-3">Genre</th>
                    <th class="col-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- //pour chaque produit de ma table produits, je créé une nouvelle ligne dans mon tableau pour l'afficher -->
                <?php foreach ($genres as $genre) : ?>
                    <tr>
                        <td><?= $genre->nom ?></td>

                        <td class=" border-start border-1"><a href="caracteristiques.php?id=<?= $genre->id_genre ?>" onclick="return confirm(' Attention, ce genre sera définitivement supprimé')"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="20px" height="20px">
                                    <path d="M 28 6 C 25.791 6 24 7.791 24 10 L 24 12 L 23.599609 12 L 10 14 L 10 17 L 54 17 L 54 14 L 40.400391 12 L 40 12 L 40 10 C 40 7.791 38.209 6 36 6 L 28 6 z M 28 10 L 36 10 L 36 12 L 28 12 L 28 10 z M 12 19 L 14.701172 52.322266 C 14.869172 54.399266 16.605453 56 18.689453 56 L 45.3125 56 C 47.3965 56 49.129828 54.401219 49.298828 52.324219 L 51.923828 20 L 12 19 z M 20 26 C 21.105 26 22 26.895 22 28 L 22 51 L 19 51 L 18 28 C 18 26.895 18.895 26 20 26 z M 32 26 C 33.657 26 35 27.343 35 29 L 35 51 L 29 51 L 29 29 C 29 27.343 30.343 26 32 26 z M 44 26 C 45.105 26 46 26.895 46 28 L 45 51 L 42 51 L 42 28 C 42 26.895 42.895 26 44 26 z" />
                                </svg></a></td>
                    </tr>
                <?php endforeach ?>


            </tbody>
        </table>
        <form method="POST" name="formulaire">

            <label for="genre">Ajoutez un genre</label>
            <input type="text" name="nom" class="form-control" placeholder="Entrez un nouveau genre">

            <button type="submit" name="submit_genre" class="btnconnexion  rounded-3 p-2 text-light mb-5 mt-3">Ajouter</button>
        </form>
    </div>


</section>









<?php
require_once 'composants/footer.php';
?>