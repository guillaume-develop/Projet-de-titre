<?php
require_once 'inc/bdd.php';



//SUPPRESSION : avant l'afficahge
if (isset($_GET['id'])) {
    $myDb->query("DELETE FROM produits WHERE id_produit = '$_GET[id]'");

    $confirm = "<div class='m-4 w-50 mx-auto alert alert-success'>Le produit est bien supprimé.</div>";
}
    


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

<section>
    <div class="d-flex col-md-12 mt-5 justify-content-start">
        <a href="ajout_produits.php"><button type="btn" class="gestion ms-3 p-1 mb-1 text-light rounded-3">gestion des commandes</button></a>
        <a href="caracteristiques.php"><button type="btn" class="gestion ms-3 p-1  mb-1 text-light rounded-3">gestion des caractéristiques produit</button></a>
    </div>

    <div class="row mt-4 col-md-11 mx-auto">
        <h2 class=" text-center">Gestion des produits</h2>
        <?php if (isset($confirm)) echo $confirm . "<br>" ?>


        <div class=" col-md-12 mx-auto d-flex justify-content-start">
            <a class="gestion btn border border text-light" href="ajouter_produit.php">Ajouter</a>
        </div>

        <table class="table border border-1 mt-2 text-center text-align-center ">

            <thead class="bg-dark text-white">

                <tr>
                    <th class="col-3">Titre</th>
                    <th class="col-2">Prix</th>
                    <th class="">Editeur</th>
                    <th>Plateforme</th>
                    <th>genre</th>
                    <th>Stock</th>
                    <th class="col-1">Afficher</th>
                    <th class="col-1">Modifier</th>
                    <th class="col-1">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <!-- //pour chaque produit de ma table produits, je créé une nouvelle ligne dans mon tableau pour l'afficher -->
                <?php foreach ($produits as $unProduit) : ?>
                    <tr>
                        <td><?= $unProduit->nom ?></td>
                        <td><?= $unProduit->prix ?> €</td>
                        <td><?= $unProduit->editeur_nom?></td>
                        <td><?= $unProduit->plateforme_nom ?></td>
                        <td><?= $unProduit->genre_nom ?></td>
                        <td><?= $unProduit->Stock ?> pce</td>


                        <!--Affichage-->
                        <td><a href="afficher_produit.php?id=<?= $unProduit->id_produit ?>"><svg fill="#000000" height="20px" width="20px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 512 512" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 512 512">
                                    <g>
                                        <path d="m494.8,241.4l-50.6-49.4c-50.1-48.9-116.9-75.8-188.2-75.8s-138.1,26.9-188.2,75.8l-50.6,49.4c-11.3,12.3-4.3,25.4 0,29.2l50.6,49.4c50.1,48.9 116.9,75.8 188.2,75.8s138.1-26.9 188.2-75.8l50.6-49.4c4-3.8 11.7-16.4 0-29.2zm-238.8,84.4c-38.5,0-69.8-31.3-69.8-69.8 0-38.5 31.3-69.8 69.8-69.8 38.5,0 69.8,31.3 69.8,69.8 0,38.5-31.3,69.8-69.8,69.8zm-195.3-69.8l35.7-34.8c27-26.4 59.8-45.2 95.7-55.4-28.2,20.1-46.6,53-46.6,90.1 0,37.1 18.4,70.1 46.6,90.1-35.9-10.2-68.7-29-95.7-55.3l-35.7-34.7zm355,34.8c-27,26.3-59.8,45.1-95.7,55.3 28.2-20.1 46.6-53 46.6-90.1 0-37.2-18.4-70.1-46.6-90.1 35.9,10.2 68.7,29 95.7,55.4l35.6,34.8-35.6,34.7z" />
                                    </g>
                                </svg></a></td>

                               <!-- modifs -->
                        <td><a href="modifier_produit.php?id=<?= $unProduit->id_produit ?>"><svg height="20px" width="20px" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:ns1="http://sozi.baierouge.fr" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" id="svg4847" sodipodi:docname="edit-icon.svg" viewBox="0 0 581.98 744.96" version="1.1" inkscape:version="0.48.4 r9939">
                                    <sodipodi:namedview id="base" bordercolor="#666666" inkscape:pageshadow="2" inkscape:window-y="24" fit-margin-left="0" pagecolor="#ffffff" inkscape:window-height="844" inkscape:window-maximized="0" inkscape:zoom="0.17110443" inkscape:window-x="0" showgrid="false" borderopacity="1.0" inkscape:current-layer="layer1" inkscape:cx="1337.0235" inkscape:cy="-553.48697" fit-margin-top="0" fit-margin-right="0" fit-margin-bottom="0" inkscape:window-width="1589" inkscape:pageopacity="0.0" inkscape:document-units="px" />
                                    <g id="layer1" inkscape:label="Layer 1" inkscape:groupmode="layer" transform="translate(-105.03 -121.31)">
                                        <g id="g4885">
                                            <g id="g4830" style="fill:#000000" transform="matrix(11.996 0 0 11.996 -1026.7 -3323.3)">
                                                <path id="path11535" sodipodi:nodetypes="sccccscccccccccccccccccccc" inkscape:connector-curvature="0" style="color:#000000;fill:#000000" d="m139.16 289.02c-1.2148-0.82153-2.4093-1.383-3.6056-1.8664l-1.2844 1.7675 7.3028 5.3067 1.2844-1.7675c-1.2539-1.5418-2.4824-2.6188-3.6972-3.4403zm-5.7164 1.0383-1.2844 1.7675 7.3028 5.3067 1.2844-1.7675zm-2.2202 3.0554-17.334 23.854 3.9697 1.2896 16.735-22.702zm4.0836 3.0131-16.643 22.656 2.2523 3.5376 17.61-23.9zm-21.862 21.863-1.8834 9.5262 8.3239-4.591-2.3632-3.5249z" />
                                                <path id="rect4819" sodipodi:nodetypes="ssssssccssssssccs" style="fill:#000000" inkscape:connector-curvature="0" d="m101.62 290.19c-4.0274 0-7.2812 3.2539-7.2812 7.2812v44.531c0 4.0274 3.2539 7.25 7.2812 7.25h29.75c4.0274 0 7.2812-3.2226 7.2812-7.25v-34.844l-4.4375 6v27.156c0 2.4813-1.9874 4.5-4.4688 4.5h-26.5c-2.4813 0-4.4688-2.0187-4.4688-4.5v-41.188c0-2.4813 1.9874-4.4688 4.4688-4.4688h21.127l2.8419-4.4688z" />
                                            </g>
                                        </g>
                                    </g>
                                    <metadata>
                                        <rdf:RDF>
                                            <cc:Work>
                                                <dc:format>image/svg+xml</dc:format>
                                                <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                                                <cc:license rdf:resource="http://creativecommons.org/licenses/publicdomain/" />
                                                <dc:publisher>
                                                    <cc:Agent rdf:about="http://openclipart.org/">
                                                        <dc:title>Openclipart</dc:title>
                                                    </cc:Agent>
                                                </dc:publisher>
                                            </cc:Work>
                                            <cc:License rdf:about="http://creativecommons.org/licenses/publicdomain/">
                                                <cc:permits rdf:resource="http://creativecommons.org/ns#Reproduction" />
                                                <cc:permits rdf:resource="http://creativecommons.org/ns#Distribution" />
                                                <cc:permits rdf:resource="http://creativecommons.org/ns#DerivativeWorks" />
                                            </cc:License>
                                        </rdf:RDF>
                                    </metadata>
                                </svg></a>
                        </td>
                        <td><a href="espaceAdmin.php?id=<?= $unProduit->id_produit; ?>" onclick="return confirm(' Attention, ce produit sera définitivement supprimé')"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="20px" height="20px">
                                    <path d="M 28 6 C 25.791 6 24 7.791 24 10 L 24 12 L 23.599609 12 L 10 14 L 10 17 L 54 17 L 54 14 L 40.400391 12 L 40 12 L 40 10 C 40 7.791 38.209 6 36 6 L 28 6 z M 28 10 L 36 10 L 36 12 L 28 12 L 28 10 z M 12 19 L 14.701172 52.322266 C 14.869172 54.399266 16.605453 56 18.689453 56 L 45.3125 56 C 47.3965 56 49.129828 54.401219 49.298828 52.324219 L 51.923828 20 L 12 19 z M 20 26 C 21.105 26 22 26.895 22 28 L 22 51 L 19 51 L 18 28 C 18 26.895 18.895 26 20 26 z M 32 26 C 33.657 26 35 27.343 35 29 L 35 51 L 29 51 L 29 29 C 29 27.343 30.343 26 32 26 z M 44 26 C 45.105 26 46 26.895 46 28 L 45 51 L 42 51 L 42 28 C 42 26.895 42.895 26 44 26 z" />
                                </svg></a></td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>

    </div>

</section>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="mx-auto col-md-5" method="POST" enctype="multipart/form-data">



                        <label for="nom">Nom</label>
                        <input type="text" value="" name="nom" class="form-control" placeholder="Entrez un nom de produit">


                        <label for="price">*Prix</label>
                        <input type="float" name="prix" class="form-control" placeholder="Entrez votre un prix">


                        <label for="editeur">Editeur</label>
                        <select name="editeur" id="" class="form-control">
                            <?php foreach ($editeurs as $unEditeur) : ?>
                                <option value="<?= $unEditeur->nom ?>"><?= $unEditeur->nom ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label for="plateforme">*Plateforme</label>
                        <select name="plateforme" id="" class="form-control">
                            <?php foreach ($plateformes as $unePlateforme) : ?>
                                <option value="<?= $unePlateforme->nom ?>"><?= $unePlateforme->nom ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label for="category">*Genre</label>
                        <select name="genre" id="" class="form-control">
                            <?php foreach ($genres as $unGenre) : ?>

                                <option value="<?= $unGenre->nom ?>"><?= $unGenre->nom ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label for="description">*description</label>
                        <input type="textArea" name="description" class="form-control" placeholder="Entrez une description">

                        <label for="ville">*Stock</label>
                        <input type="text" name="stock" class="form-control" placeholder="Nb de produits en stock">



                        <label for="photo">*image</label>
                        <input type="file" name="image" class="form-control">

                        <button type="submit" name="Modifier" class="btnconnexion  rounded-3 p-2 text-light mb-5 mt-3">Modifier</button>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>
</section>



<?php
require_once 'composants/footer.php';
?>