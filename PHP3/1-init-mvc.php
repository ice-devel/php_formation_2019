<?php
    // une découpe de fichiers intermédiaire à une structure MVC
    // MVC : model view controller
    // model : entités - les données métiers qu'il va falloir gérer
    // view : ce que l'utilisateur va voir - interface graphique
    // controller : le point d'entrée d'une demande, pour qui se charge d'orchestrer l'ensemble
    // des traitements, entités, vues...

    // ce fichier est le "controller", point d'entrée du site : il récupère le métier,
    // et le passe à la vue, puis renvoi le résultat final au serveur web, au client, etc.
    $users = [];
    if (isset($_GET['btn_search'])) {
        // 1- récupération des valeurs du formulaire, on le fait dans le controller
        // car spécifique à la plateforme, on laisse le "model" indépendant pour pouvoir le réutiliser
        // dans un autre contexte : par exemple une API
        $name = filter_input(INPUT_GET, 'name');
        $birthday = filter_input(INPUT_GET,'birthday');

        // on inclut le model, qui sert à récupérer les données métier
        include 'mvc/model.php';
        $users = getUsers($name, $birthday);
    }

    include 'mvc/vue.php'
?>
