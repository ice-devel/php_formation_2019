<?php
/**
    LES VARIABLES / CONDITIONS EXOS
 *
 * Ecrire le programme qui déclare un entier (vous l'initialisez en dur)
 * Puis afficher à l'écran si la personne est majeure ou mineure
 * Puis si elle est mineure lui indiquer combien d'années il reste avant qu'elle soit majeure.
 * Ne prenez en compte que l'année pour le calcul d'âge
**/

$age = 5;

if ($age >= 18) {
    echo "Vous êtes majeur<br>";
}
else {
    echo "Vous êtes mineur<br>";
    $anneesRestantes = 18 - $age;
    echo "Il reste ".$anneesRestantes." années avant la majorité<br>";
    // avevc les doubles guillements on peut concatener une variable directement sans sortir de la chaine
    echo "Il reste $anneesRestantes années avant la majorité<br>";
    // avec les simples guillemets ça ne marche pas
    echo 'Il reste $anneesRestantes années avant la majorité<br>';
}

$anneeActuelle = 2019; // à partir de 2020 le programme ne fonctionne plus
$anneeActuelle = date("Y");
echo $anneeActuelle.'<br>';

$dateActuelle = date("d/m/Y H:i:s");
echo $dateActuelle.'<br>';
?>