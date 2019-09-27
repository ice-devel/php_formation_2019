<?php
    include 'autoload.php';

    $db = new PDO('mysql:host=127.0.0.1;dbname=formation_php;charset=UTF8', 'root', '');
    $veloManager = new VeloManager($db);
    $velos = $veloManager->findAll();

    include 'templates/velo_list.php';
?>