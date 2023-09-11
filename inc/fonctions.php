<?php
require_once 'inc/bdd.php';


function debug( $arg ){

    print "<div style='background:orange; z-index:1000; padding: 20px;'>";
        print "<pre>";
            print_r( $arg );
        print "</pre>";
    print "</div>";
}

function isConnecte()
{
    if (!isset($_SESSION['client'])) {
        return false;
    } 
    else {
        return true;
    }
}
    function isConnecteAndIsAdmin()
{
    if (isConnecte() && $_SESSION['client']['statut'] == 1) { 
        return true; 
    } 
    else {
        return false; 
    }
}
    function isConnecteAndUser()
{
    if (isConnecte() && $_SESSION['client']['statut'] == 0) { 
        return true; 
    } 
    else {
        return false; 
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'deconnexion'){

    session_destroy();
    header('location:index.php');
}

//création du panier

function creation_panier(){

    if( !isset( $_SESSION['panier'] ) ){ //SI la session/panier N'EXISTE PAS

        $_SESSION['panier'] = array(); //Création d'une session/panier

            $_SESSION['panier']['id_produit'] = array();
            $_SESSION['panier']['nom'] = array();
            $_SESSION['panier']['prix'] = array();
            $_SESSION['panier']['image'] = array();
    }
    return true;
}

function ajout_panier( $id_produit, $nom, $prix, $image ){

    creation_panier(); //Ici, on fait appel à la fonction déclarée ci-dessus 
        //SOIT la panier n'existe et donc et donc on le crée (LA première fois que l'on tente d'ajouter un produit dans notre panier)
        //SOIT il existe et donc on l'utilise

    $_SESSION['panier']['id_produit'][] = $id_produit;
        //Ici, on précise des crochets vides, car on souhaite ajouter une information à ce 'sous-tableau' (ex: il pourrait y avoir plusieurs titres s'il y a plusieurs produits !)
    $_SESSION['panier']['nom'][] = $nom;  
    $_SESSION['panier']['prix'][] = $prix;
    $_SESSION['panier']['image'][] = $image;
}
//addition du panier
    function prixTotal(){
        $total=0;

        for($pt=0;$pt < count($_SESSION['panier']['prix']);$pt++){

            $total += $_SESSION['panier']['prix'][$pt];
        }
        return $total;
    }
    //fonction de suppression du panier
    function supprimerProduit($id_produit){
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier']=array();

            //creation d'un panier temporaire qui va sauver les éléments a garder
            $tmpanier=array();
                //je recree mon tableau dans cette variable temporaire
                $tmpanier['id_produit']=array();
                $tmpanier['nom']=array();
                $tmpanier['qtProduit']=array();
                $tmpanier['prix']=array();
                $tmpanier['image']=array();

            //Je créé une boucle pour dire tant qu'il existe des produits dans mon panier,
                for($i=0;$i < count($_SESSION['panier']['id_produit']);$i++){

                    //et si l'id du produit ne correspond pas à l'id du produit que je veux supprimer, celui
                    //est stocké dans mon panier temporaire. 
                    if ($_SESSION['panier']['$id_produit'][$i] !== $id_produit){
                        array_push( $tmpanier['panier']['id_produit'], $i);
                        array_push( $tmpanier['panier']['nom'], $i);
                        array_push( $tmpanier['panier']['qtProduit'], $i);
                        array_push( $tmpanier['panier']['prix'], $i);
                        array_push( $tmpanier['panier']['image'], $i); 
                    }
                }
                //le panier est mis a jour 
                $_SESSION['panier']=$tmpanier;
                // Le panier temporaire est supprimé
                unset($tmp);
        }
    }
    function modifierQt($id_produit, $qtProduit) {
        if (creation_panier()){
                //S'il y a plus de 0 produits on peut modifier la valeur
            if ($qtProduit > 0) {
                $produitVerify = array_search($id_produit, $_SESSION['panier']['id_produit']);
                //et qu'iol existe
                if ($produitVerify !==false) {
                    //on modifie la qte
                    $_SESSION['panier']['qtProduit'][$produitVerify] = $qtProduit;
                }
            }else {
                //Sinon le produit est supprimé
                supprimerProduit($id_produit);
            }
        }
    }
    function supprimerPanier(){
        unset($_SESSION['panier']);
    }

