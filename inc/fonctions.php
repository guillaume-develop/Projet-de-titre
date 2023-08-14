<?php
//je cree ma fonction pour pouvoir ajouter des produits



// function afficher($myDb)
// {
//     if($myDb)
//     {
//         $recup = $myDb->prepare("SELECT * FROM produits ORDER BY id_produit DESC"); 

//         $recup->execute();

//         $dataP = $recup->fetchAll(PDO::FETCH_OBJ);

//         return $dataP;

//     } 
// }


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
