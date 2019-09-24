<?php
/*
    LES VARIABLES
*/
echo "Les variables<br>";

// les variables servent à utiliser des emplacements en mémoire vive,
// pour y stocker une valeur

// LES DIFFERENTS TYPES DE VARIABLES
// types primitifs
$toto = "chaine de caractères";
$nomFamille = "Dupont";
var_dump($toto);

$entier = 10;
var_dump($entier);

// PHP n'est pas typé, ou plutôt c'est un langage faiblement typé :
// ce qui veut que l'on n'est pas obligé de préciser le type des variables
// et qu'une variable peut changer de type pendant le même script
$entier = "chaine";
var_dump($entier);

$booleen = true;
var_dump($booleen);

$float = 10.59;
var_dump($float);

/**
 * Opérations
 */
/** opérations arithmétiques **/
$chiffre1 = 5;
$chiffre2 = 16;
echo $chiffre1 + $chiffre2;
echo "<br>";

echo $chiffre1 + $chiffre2;
echo "<br>";

echo $chiffre1 - $chiffre2;
echo "<br>";

echo $chiffre1 * $chiffre2;
echo "<br>";

echo $chiffre1 / $chiffre2;
echo "<br>";
// attention, comme en maths, la division par 0 est impossible

// priorité sur les opérateurs : d'abord les multiplications et divisions
// sinon mettre des parenthèses pour prioriser
echo 5 + 16 * 20 - 5;
echo "<br>";
echo (5 + 16) * 20 - 5;
echo "<br>";

// modulo : calculer le reste de
echo 150 % 6;
echo "<br>";
echo 151 % 6;
echo "<br>";

/** opérations chaines de caractères **/
echo "test"."test2";
echo "<br>";
$chaine1 = "bonjour";
$chaine2 = "toto";
echo $chaine1." ".$chaine2."<br>"

?>