<?php
include 'autoload.php';

$db = new PDO('mysql:host=127.0.0.1;dbname=formation_php;charset=UTF8', 'root', '');
$veloManager = new VeloManager($db);

// on récupère l'id dans l'url, c'est l'id du produti que l'on veut supprimer
$id = filter_input(INPUT_GET, 'id');

$velo = $veloManager->find($id);

if ($velo !== false) {
    $veloManager->delete($velo);
}

// on redirige vers la page d'accueil, d'affichage des produits
header("Location: getVelos.php");

?>