<?php
/**
 * Structures itératives ou boucles : exercice
 * 1-Déclarer un tableau et remplissez le de 200 valeurs aléatoires comprises en 10 et 50

 * 2a- Afficher la somme de toutes ces valeurs
 * 2b- Afficher la moyenne de toutes ces valeurs
 **/

$tableauValeurs = [];

// au lieu de faire ça, on va utiliser pour éviter d'écrire la même instruction 200 fois
/*
$tableauValeurs[] = rand(10, 50);
$tableauValeurs[] = rand(10, 50);
$tableauValeurs[] = rand(10, 50);
$tableauValeurs[] = rand(10, 50);
$tableauValeurs[] = rand(10, 50);
*/

$nbElements = 200;
for ($i=0; $i < $nbElements; $i++) {
    $random = rand(10, 50);
    $tableauValeurs[] = $random;
}

$somme = 0;
/*
$somme = $somme + $tableauValeurs[0];
$somme = $somme + $tableauValeurs[1];
$somme = $somme + $tableauValeurs[2];
*/
foreach ($tableauValeurs as $value) {
    $somme = $somme + $value;
}
echo $somme.'<br>';

// besoin de connaitre le nombre dans un tableau : fonction count()
// $nbElements = count($tableauValeurs);
echo "Moyenne : ".($somme / $nbElements);


// le tout en une seule boucle
$nbElements = 200;
$somme = 0;
for ($i=0; $i < $nbElements; $i++) {
    $random = rand(10, 50);
    $tableauValeurs[] = $random;
    $somme = $somme + $random;
}

?>