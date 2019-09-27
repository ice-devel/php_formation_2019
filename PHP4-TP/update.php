<?php
    include 'autoload.php';

    $db = new PDO('mysql:host=127.0.0.1;dbname=formation_php;charset=UTF8', 'root', '');
    $veloManager = new VeloManager($db);
    $colorManager = new ColorManager($db);

    $id = filter_input(INPUT_GET, 'id');

    if ($id !== null) {
        $velo = $veloManager->find($id);
        // si le vélo dont l'id est passé en GET exite vraiment en bdd, alors on affiche on affiche
        if ($velo !== false) {
            if (isset($_POST['btn_valid'])) {
                // ici on a validé le formulaire de modification
                // 1- récupérer les données du formulaire
                $name = filter_input(INPUT_POST, 'name');
                $size = filter_input(INPUT_POST, 'size');
                $frame = filter_input(INPUT_POST, 'frame');
                $suspension = filter_input(INPUT_POST, 'suspension');
                $price = filter_input(INPUT_POST, 'price');
                $colorId = filter_input(INPUT_POST, 'color');

                // 2- vérifier si les données sont valides
                $errors = [];
                if ($name === null || $name === "") {
                    $errors['name'] = "Veuillez saisir un nom";
                }
                if ($frame != Velo::FRAME_MAN && $frame != Velo::FRAME_WOMAN && $frame != Velo::FRAME_MIXED) {
                    $errors['frame'] = "Veuillez saisir un cadre valide";
                }
                // vérifier si la couleur existe en bdd
                $colorExist = $colorManager->find($colorId);
                if ($colorId !== "" && $colorExist === false) {
                    $errors['color'] = "Veuillez sélectionner une couleur valide";
                }

                if (count($errors) == 0) {
                    // 3- modifier les propriétés
                    $velo->setName($name);
                    $velo->setSize($size);
                    $velo->setFrame($frame);
                    $velo->setSuspension($suspension);
                    $velo->setPrice($price);

                    if ($colorExist !== false) {
                        $velo->setColor($colorExist);
                    }
                    else {
                        $velo->setColor(null);
                    }

                    // 4- enregistrer les modifications
                    $result = $veloManager->update($velo);
                    if ($result) {
                        echo "Modification prise en compte";
                    }
                    else {
                        echo "Une erreur est survenue";
                    }
                }
                else {
                    foreach ($errors as $error) {
                        echo $error."<br>";
                    }
                }
            }

            // recupérer toutes les couleurs en bdd pour dynamiser la liste déroulante html
            $colors = $colorManager->findAll();
            include 'templates/velo_update.php';
        }
        else {
            header('Location: getVelos.php');
            exit;
        }
    }
    else {
        header('Location: getVelos.php');
        exit;
    }
?>