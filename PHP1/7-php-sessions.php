<?php
    // démarrer les sessions sur cette page, sans ça vous n'avez pas accès aux variables de session
    // l'appel de cette fonction doit être fait avant tout html
    session_start();

    if (isset($_POST['btn_login'])) {
        $login = filter_input(INPUT_POST, 'login');
        $pass = filter_input(INPUT_POST, 'password');

        if ($login == "admin" && $pass == "cool") {
            // les identifiants sont corrects donc on va authentifier l'utilisateur
            // en lui créant une variable de session particulière
            $_SESSION['login'] = $login;
        }
        else {
            echo "Mauvais identifiants";
        }
    }

    if (isset($_SESSION['login'])) {
        echo "Utilisateur connecté : ".$_SESSION['login'];
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
    La connexion dans ce fichier se fait via les sessions : les informations sont transférées de page en page
    en stockant les données sur le serveur, et la liaison est faite avec un identifiant qui lui se trouve
    dans le navigateur
</p>
</body>
</html>