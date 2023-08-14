<?php
require_once 'inc/bdd.php'
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
            <input type="text" class="form-control" placeholder="Recherche..." name="recherche">
            <button class="search-btn  mx-2">Rechercher</button>
        </form>
    </div>
</div>