<?php

if (isset($_POST['btn_valid'])) {
    include "entity/Product.php";
    include "entity/ProductManager.php";

    // 1- récupérer les valeurs du formulaire
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price');
    $description = filter_input(INPUT_POST, 'description');
    $isOnline = filter_input(INPUT_POST, 'is_online');

    // vérifier si les valeurs envoyées sont valide
    $errors = [];
    if ($name === null || $name === "") {
        // erreur
        $errors['name'] = "Veuillez saisir un nom de produit";
    }

    // on fait la requete seulement si il n'y a pas d'erreur dans le formulaire
    if (count($errors) == 0) {
        // 2- créer un objet et "l'hydrater"
        $product = new Product("", $name, $price, $description, $isOnline);

        // 3- utiliser le manager pour enregistrer ce produit en bdd
        $db = new PDO('mysql:host=127.0.0.1;dbname=formation_php;charset=UTF8', 'root', '');
        $productManager = new ProductManager($db);
        $result = $productManager->create($product);
        if ($result) {
            echo "Produit bien créé";
        }
        else {
            echo "Erreur";
        }
    }
    else {
        foreach ($errors as $error) {
            echo $error."<br>";
        }
    }

}

// controller
include "templates/product_create.html";

?>