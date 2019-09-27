<?php
    include 'autoload.php';

    if (isset($_POST['btn_valid'])) {
        // 1- récupération des données du formulaire
        $name = filter_input(INPUT_POST, 'name');
        $size = filter_input(INPUT_POST, 'size');
        $frame = filter_input(INPUT_POST, 'frame');
        $suspension = filter_input(INPUT_POST, 'suspension');
        $price = filter_input(INPUT_POST, 'price');

        // 2- vérification de la validité des données

        // 3- instanciation de l'objet
        $velo = new Velo("", "", $name, $size, $price, $frame, $suspension);

        $db = new PDO('mysql:host=127.0.0.1;dbname=formation_php;charset=UTF8', 'root', '');
        $veloManager = new VeloManager($db);
        $result = $veloManager->insert($velo);

        if ($result) {
            echo "Vélo bien ajouté";
        }
        else {
            echo "Une erreur est survenue";
        }
    }

    include 'templates/velo_create.php'
?>