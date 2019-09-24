<?php
    session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    En session :<br>
    <?php
        if (isset($_SESSION['panier'])) {
            // parcourir le tableau des produits en session
            // $value est le tableau associatif représentant un produit et sa quantité
            foreach ($_SESSION['panier'] as $value) {
                echo $value['produit'].' : '.$value['quantite'].'<br>';
            }
        }
    ?>

    <br>
    En cookie :<br>
    <?php
        if (isset($_COOKIE['panier'])) {
            // le cookie possède une chaine de caractère, il faut la "unserializer" pour l'utiliser comme un tableau
            $cookieTableau = unserialize($_COOKIE['panier']);
            // parcourir le tableau des produits en cookie
            // $value est le tableau associatif représentant un produit et sa quantité
            foreach ($cookieTableau as $value) {
                echo $value['produit'].' : '.$value['quantite'].'<br>';
            }
        }
    ?>
</body>
</html>