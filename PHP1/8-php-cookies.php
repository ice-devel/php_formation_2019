<?php
    if (isset($_POST['btn_login'])) {
        $login = filter_input(INPUT_POST, 'login');
        $pass = filter_input(INPUT_POST, 'password');

        if ($login == "admin" && $pass == "cool") {
            // les identifiants sont corrects donc on va authentifier l'utilisateur
            // en lui créant un cookie particulier
            setcookie('login', $login);
        }
        else {
            echo "Mauvais identifiants";
        }
    }

    if (isset($_COOKIE['login'])) {
        echo "Utilisateur connecté : ".$_COOKIE['login'];
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

    <form method="post">
        <input type="text" name="login" placeholder="Login"/>
        <input type="password" name="password" placeholder="Mot de passe"/>
        <input type="submit" value="Se connecter" name="btn_login"/>
    </form>

<p>
    La connexion dans ce fichier se fait via les cookies : les informations sont transférées de page en page
    en stockant les données dans le navigateur du client
</p>

<!--
    Créer une page avec un formulaire :
    - une liste déroulante avec plusieurs produits
    - une champ numérique pour choisir la quantité de ce produit
    - le bouton valider

    Quand vous validez ça met en session ou en cookie votre choix
    Vous pouvez retourner sur le formulaire et ajouter d'autres produits

    Enfin vous faites une page qui affiche tous les produits dans le panier (session ou cookie)
    Remarque : ce n'est pas une valeur scalaire qu'il faut mettre en session, mais un tableau :
    [
      [
        'produit' => $nom
        'quantite' => $quantite
      ],
      [
        'produit' => $nom2
        'quantite' => $quantite2
      ]
    ]

-->

</body>
</html>