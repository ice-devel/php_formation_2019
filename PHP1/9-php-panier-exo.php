<?php
    session_start();

    // on teste si le formulaire a été soumis
    if (isset($_POST['btn_valid'])) {
        $produit = filter_input(INPUT_POST, 'produit');
        $quantite = filter_input(INPUT_POST, 'quantite');

        // $var[] = "quelquechose"
        // array_push($var, "quelquechose");

        $_SESSION['panier'][] = ['produit' => $produit, 'quantite' => $quantite];
    }

    // la même chose mais en mettant dans les cookies plutôt qu'en session
    if (isset($_POST['btn_valid'])) {
        $produit = filter_input(INPUT_POST, 'produit');
        $quantite = filter_input(INPUT_POST, 'quantite');

        $produitEtQuantite = ['produit' => $produit, 'quantite' => $quantite];
        // récupération du panier déjà en cookie et ajout du nouveau produit dans ce cookie
        // sans écraser les précédents
        if (isset($_COOKIE['panier'])) {
            // ici il y a déjà dans le panier, on les récupère sous forme de tableau
            $cookieTableau = unserialize($_COOKIE['panier']);
        }
        else {
            // uniquement quand il n'y aucun produit dans le panier
            $cookieTableau = [];
        }

        // on ajoute le nouveau produit dans le panier
        $cookieTableau[] = $produitEtQuantite;

        // dans les cookies, impossible de mettre un tableau, donc on le "serialize" avant
        $cookieString = serialize($cookieTableau);

        // ajout dans les cookies du navigateur
        setcookie('panier', $cookieString);
    }
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
    <form method="post" action="">
        <select name="produit">
            <option></option>
            <option>Processeur</option>
            <option>Carte graphique</option>
            <option>Disque dur</option>
        </select>

        <input type="number" placeholder="Quantité" name="quantite"/>

        <input type="submit" value="Ajouter au panier" name="btn_valid"/>
    </form>
</body>
</html>