<?php
/**
 Structures itératives ou boucles :
 * exécuter une ou des instructions un certain de nombre de fois
 **/

// for : à utiliser quand on connait le nombre d'itérations
for ($indice=0; $indice < 10; $indice++) {
    echo "Itération n°".$indice."<br>";
}

// while (tant que) : à utiliser quand on ne
// connait pas le nombre d'itération à l'avance
// et que le nb d'itération peut être 0
$nombre = 5;
$nbTour = 0;
while ($nombre <= 100) {
    $random = rand(1,10); // génère un entier aléatoire entre 1 et 10
    $nombre = $nombre + $random;
    $nbTour++;
}
echo "Nombre de tours : ".$nbTour." / ".$nombre."<br>";

// do while (répéter jusqu'à) : ne pas connaitre le nb d'itération
// et vouloir rentrer au moins une fois dans la boucle
$nombre = 5;
do {
    $random = rand(1,10);
    $nombre = $nombre + $random;
} while($nombre <= 100);
echo $nombre."<br>";


// les tableaux : array : un ensemble de valeur
// en PHP un tableau peut contenir différents types de valeur
/**
 * Tableaux numériques
 */
$tableau = array();
$tableau = [];

// ajouter des éléments dans un tableau
$tableau = ["chaine", 15, true, "chaine2"];

// push avec notation raccourcie
$tableau2 = [];
$tableau2[] = "chaine1";
$tableau2[] = "chaine2";
$tableau2[] = "chaine3";

// push avec la fonction native
array_push($tableau2, "chaine4");

// accéder à un élément en particulier : on utilise l'indice de cet élément
echo $tableau2[1]."<br>";

// modifier un élément en particulier
$tableau2[1] = "chaine2 modifiée";
echo $tableau2[1]."<br>";

// parcourir un tableau numérique pour afficher chacun de ses éléments
$tableauNumerique = ["test", "test2", "test3"];
for ($i=0; $i<= 2; $i++) {
    echo $tableauNumerique[$i]."<br>";
}

/**
 * Tableaux associatifs
 */
$tableauAssociatif = [];
$tableauAssociatif['cle2'] = "valeur 1 du tab associatif";
$tableauAssociatif['toto_nom'] = "valeur 2 du tab associatif";
$tableauAssociatif['ville'] = "lille";
$tableauAssociatif['cp'] = "59000";

// echo $tableauAssociatif['cle2'].'<br>';

/*
 * Impossible pour un tableau associatif d'utiliser la boucle for
for ($i = 0; $i <= 3; $i++) {
    echo $tableauAssociatif[$i]."<br>";
}
*/
foreach ($tableauAssociatif as $value) {
    echo $value."<br>";
}

foreach ($tableauAssociatif as $key => $toto) {
    echo $key." : ".$toto."<br>";
}

?>