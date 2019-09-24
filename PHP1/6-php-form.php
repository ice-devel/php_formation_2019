<?php
    // on va vérifier si le formulaire a été soumis : on regarde si une clé existe
    // dans le tableau GET ou POST en fonction du type de requête
    if (isset($_GET['btn_valid'])) {
        // récupérer chaque information envoyée depuis le formulaire
        $nom = filter_input(INPUT_GET, 'name');
        $email = filter_input(INPUT_GET, 'email');
        $pass = filter_input(INPUT_GET, 'pass');

        /* il faut vérifier si la clé a été envoyée
        if (isset($_GET['couleur'])) {
            $couleurs = $_GET['couleur'];
        }
        else {
            $couleurs = null;
        }
        */
        // pour récupérer un tableau de valeur, remplir le 4em paramètre de filter_input
        $couleurs = filter_input(INPUT_GET, 'couleurs', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $situation = filter_input(INPUT_GET, 'situation');

        var_dump($nom);
        var_dump($email);
        var_dump($pass);
        var_dump($couleurs);
        var_dump($situation);

        // par exemple ensuite on peut enregistrer les données récupérées en BDD
    }

    if (isset($_GET['page'])) {
        $numPage = $_GET['page'];
        echo "Numéro de la page : ".$numPage;
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
        <style></style>
    </head>

    <body>
       <h1>Formulaire</h1>

       <!-- attribut action : vers quelle page on envoie les données du formulaire
        method : choix entre GET et POST, GET affiche les params dans l'url, POST les cache
       -->
        <form action="" method="get">
            <label for="name">Nom :</label>
            <input id="name" type="text" name="name"/><br>

            <label>Votre email :</label>
            <input type="email" name="email"/><br>
            <input type="password" name="pass" placeholder="Tapez votre mot de passe"/><br>
            <br>

            <input type="checkbox" id="couleur_rouge" name="couleurs[]" value="red"/>
            <label for="couleur_rouge">Rouge</label><br>

            <input type="checkbox" id="couleur_bleu" name="couleurs[]" value="blue"/>
            <label for="couleur_bleu">Bleu</label><br>

            <input type="checkbox" id="couleur_vert" name="couleurs[]" value="green"/>
            <label for="couleur_vert">Vert</label><br>

            <br>

            <input type="radio" name="situation" value="0"/><label>Célib</label>
            <input type="radio" name="situation" value="1"/><label>Marié(e)</label>
            <input type="radio" name="situation" value="2"/><label>Veuf/veuve</label>

            <input type="submit" value="Valider" name="btn_valid"/>
        </form>

       <a href="6-php-form.php?page=1">Page 1</a>
       <a href="6-php-form.php?page=2">Page 2</a>
        <!--
            Exo :
            Créer une page HTML qui contient un formulaire de connexion
            Un champ login et un champ mot de passe
            Le formulaire doit envoyer les données vers cette même page
            en post. Lorsque le formulaire est soumis, PHP doit vérifier
            que c'est un admin qui s'est connecté, donc vérifier que
            le login saisi est bien "admin" et que le mot de passe est bien
            "cool"
            Enfin, afficher "Vous êtes connecté" si les accès sont bons
            sinon afficher "Mauvais identifiants", peu importe où vous
            voulez dans la page web

        -->
    </body>
</html>