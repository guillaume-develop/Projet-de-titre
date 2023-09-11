
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Iso&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css\style.css">
    <title>Retro gaming shop</title>
</head>

<body>

    <!-- entete de la page -->
    <header class="header mx-auto d-flex flex-column ">  <!--titre de la page-->
    
        <nav class="navbar navbar-expand-lg" id="nav-down">
            <!-- //menu des articles             -->
            <div class="container-fluid">
                <a href="index.php"><img class="rounded-5 ms-2" src="assets/logo.jpg" width="60px"></a>
                <a class="navbar-brand" href="#"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown1" aria-controls="navbarNavDropdown1" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown1">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white  mb-1 border border-2 border-grey rounded-3" href="#" id="navbarDropdownMenuLink" role="button"data-bs-toggle="dropdown" aria-expanded="false">
                                Articles
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Jeux vidéos</a></li>
                                <li><a class="dropdown-item" href="#">Figurines</a></li>
                                <li><a class="dropdown-item" href="#">Goodies</a></li>
                            </ul>
                        </li>                      
                    </ul>
                </div>
                <div class="haut ms-auto ">
                    <nav class="navbar navbar-expand-lg navbar-light" id="menu-connect">
                        <div class="container-fluid dropdown">
                            <?php if (isConnecteAndUser()) { ?>
                                <a href="panier.php" class="justify-content-right"><img width="50px" src="assets/icon/panier.png" alt="panier"><a>
                                    <?php } else{ ?>
                                    <?php } ?>
                                    <a class="dropdown-item" href="monCompte.php">
                                        <a class="navbar-brand" href="#"></a>
                                        <button class="navbar-toggler " type="button" data-bs-toggle="collapse"     data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"   aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>
                                        <div class="row-col-md-5 collapse navbar-collapse dropdown-content"     id="navbarNavDropdown">
                            <ul class="navbar-nav ">
                                <li class="nav-item dropdown">                          
                            
                                    <a class="nav-link dropdown-toggle text-white ms-5 mb-1 border border-2     border-grey rounded-3  " href="#" id="navbarDropdownMenuLink" role="button"     data-bs-toggle="dropdown" aria-expanded="false">
                                    Menu
                                    </a>
                                    <ul class="dropdown-menu dropdown-content dropdown-menu-left"   aria-labelledby="navbarDropdownMenuLink">

                                        <?php if (!isConnecte()) { ?>
                                            <li><a class="dropdown-item" href="connexion.php">Connexion</a></li>
                                            <li><a class="dropdown-item" href="inscription.php">Inscription</a></li>
                                        <?php } else { ?>
                                            <li><a class="dropdown-item" href="monCompte.php">Mon compte</a></li>
                                            <li><a class="dropdown-item" href="index.php?   action=deconnexion">déconnexion</a></li>
                                        <?php } ?>
                                    

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <?php if (isConnecteAndIsAdmin()) : ?>
                                        <a class="text-white text-decoration-none border border-2 rounded-3 p-2 ms-4 mb-1" href="espaceAdmin.php" id="back">BackOffice</a>
                                    <?php endif; ?>
                        </div>
                    </nav>
                </div>
            </div>
        </nav>
    </header>
    <!-- <h1 class="title col-md-5 mx-auto color-danger">Retro gamming Shop</h1> -->

    <main>