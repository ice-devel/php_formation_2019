<?php
/**
 * Auto-chargement de classes
 * Passage par référence
 */
function getEntity($classe) {
    if (file_exists("Entity/".$classe.".php")) {
        include "Entity/".$classe.".php";
    }
}
function getModel($classe) {
    $file = "Model/".$classe.".php";
    if (file_exists($file)) {
        include $file;
    }
}

spl_autoload_register('getEntity');
spl_autoload_register('getModel');

// la classe Test n'est pas connu à ce stade, donc les fonctions enregistrées
// avec spl_autoload_register vont être appelées dans l'ordre
// ces fonctions doivent inclure les classes demandées
$test = new Test();

// passage par valeur != passage par référence
function toUpper($string) {
    $string = strtoupper($string);
    return $string;
}

$toto = "toto";
echo toUpper($toto)."<br>";
echo $toto."<br>";
// passage par valeur : la variable d'origine n'est pas modifiée
// même si la fonction à laquelle il est passé modifie la valeur de la variable
// passage par valeur : par défaut pour les types string, int, boolean :
// les types primitifs

// pour passer un type primitif par référence, il faut utiliser le &
// un passage par référence fait que la variable initiale est modifiée
// si la fonction modifie cette variable
function add1(&$param) {
    $param = $param + 1;
    return $param;
}

$entier = 2;
echo add1($entier)."<br>";
echo add1($entier)."<br>";
echo $entier."<br>";

$entier2 = 8;
echo add1($entier2)."<br>";
echo $entier2."<br>";

$now = new DateTime();
echo $now->format('d/m/Y H:i')."<br>";

function addOneDay(DateTime $datetime) {
    $datetime->add(new DateInterval('P1D'));
}

addOneDay($now);
echo $now->format('d/m/Y H:i')."<br>";

$test = new Test();
$test->setName('bonjour');
echo $test->getName()."<br>";

function setNameTestToUpper(Test $var) {
    $var->setName('SALUT');
}
// l'objet test est passé par référence par défaut
setNameTestToUpper($test);
echo $test->getName()."<br>";

function cloneObjectTest(Test $var) {
    $var = clone $var;
    $var->setName('coucou');
}
cloneObjectTest($test);
echo $test->getName()."<br>";

// même principe pour les affectations
// objet : affectation par référence
$test2 = new Test();
$test2->setName("John");
$test3 = $test2;
$test3->setName('Camille');

echo $test2->getName()."<br>";
echo $test3->getName()."<br>";

// types primitifs : affectation par valeur
$string = "bonjour";
$string2 = $string;
$string2 = "coucou";
echo $string."<br>";
echo $string2."<br>";
$string3 = "bonjour";

// comparaison
if ($string == $string2) { // faux
    // bonjour n'est pas égal à coucou
}
if ($string === $string2) { // faux
    // bonjour n'est pas égal à coucou même si le type string est égal au type string
}
if ($string == $string3) {

}

$test = new Test();
$test->setName('jean');
$test2 = new Test();
$test2->setName('jean');

// opérateur de comparaison sur les objets vérifier que les deux variables
// sont du même type objet, et que toutes leurs propriétés aient les mêmes valeurs
if ($test == $test2) { // vrai
    echo "jean == jean";
}

$test = new Test();
$test->setName('victor');
$test2 = new Test();
$test2->setName('jean');

if ($test == $test2) { // vrai
    echo "victor == jean";
}

// opérateur de comparaison strict : teste si la référence (l'id) de deux objets
// est la même (donc que nous avons à faire au même objet représenté par deux noms
// différents de variable)
$test = new Test();
$test->setName('jean');
$test2 = new Test();
$test2->setName('jean');

if ($test === $test2) { // faux

}

$test = new Test();
$test->setName('jean');
$test2 = $test;

if ($test === $test2) { // vrai

}

?>
