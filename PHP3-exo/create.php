<?php

if (isset($_POST['btn_valid'])) {
    include "entity/Product.php";
    include "entity/ProductManager.php";

    // 1- récupérer les valeurs du formulaire

    // 2- créer un objet et "l'hydrater"
    $product = new Product();

    // penser à convertir le "isOnline" récupéré du formulaire en 0 ou en 1
    $product->setIsOnline(0);

    // 3- utiliser le manager pour enregistrer ce produit en bdd
    $db = "quelquechose";
    $productManager = new ProductManager($db);
    $productManager->create($product);
}

// controller
include "templates/product_create.html";

?>