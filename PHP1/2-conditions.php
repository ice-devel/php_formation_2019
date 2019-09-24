<?php
/**
 Structures conditionnelles
 **/
// exécuter une instruction ou une suite d'instructions si une condition est vraie
if (true) {
    echo "Toujours vraie<br>";
}

if (5 == 10) {
    echo "5 est à égal à 10<br>";
}

$chiffre1 = 10;
$chiffre2 = 20;
if ($chiffre1 == $chiffre2) {
    echo $chiffre1." est à égal à ".$chiffre2;
}

// opérateur de comparaison
if ($chiffre1 > $chiffre2) {
    echo $chiffre1." est à supérieur à ".$chiffre2."<br>";
}
if ($chiffre1 < $chiffre2) {
    echo $chiffre1." est à inférieur à ".$chiffre2."<br>";
}
if ($chiffre1 <= $chiffre2) {
    echo $chiffre1." est à inférieur ou égal à ".$chiffre2."<br>";
}
if ($chiffre1 >= $chiffre2) {
    echo $chiffre1." est à supérieur ou égal à ".$chiffre2."<br>";
}
if ($chiffre1 != $chiffre2) {
    echo $chiffre1." est différent de ".$chiffre2."<br>";
}

// conditions multiples
if ($chiffre1 < $chiffre2 && 5 == 5) {
    echo $chiffre1." est à inférieur à ".$chiffre2." et 5 = 5<br>";
}
if ($chiffre1 < $chiffre2 || 5 == 4) {
    echo $chiffre1." est à inférieur à ".$chiffre2." ou 5 = 4<br>";
}

if (16 > 15 || 5 == 5 && 2 > 3) {
    echo "oui1<br>"; // ici on rentre
}

if ((16 > 15 || 5 == 5) && 2 > 3) {
    echo "oui2<br>"; // ici on rentre pas
}

// sinon
if (4 == 5) {
    echo "4 est égal à 5<br>";
}
else {
    echo "4 n'est pas égal à 5<br>";
}

// sinon si
if (4 == 5) {
    echo "4 est égal à 5<br>";
}
elseif (6 > 4) {
    echo "6 est supérieur à 4<br>";
}
else {
    echo "4 n'est pas égal à 5 et 6 n'est pas supérieur à 4<br>";
}

// inverser un boolean
if (!5 == 5) {
    echo "On ne rentre pas ici<br>";
}
$boolean1 = true;
$boolean2 = false;
$boolean3 = true;
if (!($boolean1 == $boolean2 && $boolean2 == $boolean3)) {
    echo "On rentre<br>";
}

// notation raccourcie
if ($boolean1 == true) {}
// correspond à
if ($boolean1) {}

if ($boolean1 == false) {}
// correspond à
if (!$boolean1) {}

// pas besoin d'alcolade : seulement si il y a une seule instruction dans le if
if (false)
    echo "test<br>";

echo "test2<br>";

// conditions ternaire : condition ? valeur si vrai : valeur si faux
$toto = isset($nom) ? $nom : "Toto";
echo $toto."<br>";

// selon
$variableEntier = 10;
switch ($variableEntier) {
    case 5:
        echo "Pas beaucoup";
        break;
    case 10:
        echo "Moyen";
        break;
    case 15:
        echo "Beaucoup";
        break;
    default:
        echo "Je sais pas";
}


?>