<?php
include "entity/Product.php";
include "entity/ProductManager.php";

$db = new PDO('mysql:host=127.0.0.1;dbname=formation_php;charset=UTF8', 'root', '');
$productManager = new ProductManager($db);

// on récupère l'id dans l'url, c'est l'id du produti que l'on veut supprimer
$id = filter_input(INPUT_GET, 'id');

$product = $productManager->find($id);

if ($product !== false) {
    $productManager->delete($product);
}

// on redirige vers la page d'accueil, d'affichage des produits
header("Location: index.php");

?>