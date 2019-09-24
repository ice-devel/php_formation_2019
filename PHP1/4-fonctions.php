<?php
/**
 * Les fonctions : centraliser un groupe d'instruction afin de pouvoir les exécuter à plusieurs endroits
 * dans le code sans avoir besoin de les réécrire
 **/

// déclaration de la fonction : la signature nom + paramètre / corps
function direBonjour() {
    echo "Bonjour<br>";
}

direBonjour();
direBonjour();

function bonjourEnFrancais() {
    $mot = "bonjour<br>";
    return $mot;
}

echo bonjourEnFrancais();
$bjFR = bonjourEnFrancais();
echo $bjFR."<br>";

// si on avait une formule à appliquer, il faudrait l'écrire à chaque endroit où on en a besoin
$largeur = 5;
$longueur = 6;
echo ($largeur * $longueur)."m²<br>";

$largeur = 4;
$longueur = 5.5;
echo ($largeur * $longueur)."m²<br>";

// on écrit une fonction qui calcule une surface, grâce à des paramètres
// attention : les paramètres d'une fonction ont une portée locale : elles ne sont utilisables
// que dans le corps de la fonction
function calculSurface($long, $larg) {
    // le mot clé global premet de modifier vraiment la variable dans le code php principal
    /*
    global $varGlobal;
    $varGlobal = 15;
    */

    $surface = $long * $larg;
    return $surface;
}

$longueurChambre = 4;
$largeurChambre = 3;
// on appelle cette fonction en lui donnant les valeurs que l'on souhaite utiliser pour les paramètres
echo calculSurface($longueurChambre, $largeurChambre).'<br>';
echo calculSurface(10, 2).'<br>';
echo calculSurface(4, 1).'<br>';
echo calculSurface(2.5, 2.9).'<br>';

// appel d'une fonction en modifiant une variable global
$varGlobal = 5;
echo calculSurface(2.5, 2.9).'<br>';
echo $varGlobal."<br>";

// une fonction peut avori des paramètres optionnels,
// c'est à dire des paramètres qui ont une valeur par défaut :
// ils sont toujours situés en dernier dans la signature
function toUpper($mot, $display=false) {
    $motEnMajuscule = strtoupper($mot);

    if ($display) {
        echo $motEnMajuscule;
    }

    // un return termine une fonction
    return $motEnMajuscule;
}

$var = toUpper("test");
$var2 = toUpper("bonjour");
$motEnMaj = toUpper("salut", true);
echo "<br>";

toUpper( "test");


/**
 * Fonctions natives PHP
 * 1- Fonctions sur les chaines de caractères
 */

$chaine = "bonjour";
// strtoupper qui met en majuscule une chaine
$chaine = strtoupper($chaine);
// strtolower qui met en minuscule une chaine
$chaine = strtolower($chaine);
// strtolower qui retourne la longueur d'une chaine
$nbCharsChaine = strlen($chaine);
// str_replace permet de remplacer quelquechose par quelquechose d'autre dans une chaine
//$chaine = str_replace("b", "B", $chaine);
$chaine = str_replace("o", "ô", $chaine);
// preg_replace pour faire des remplacements plus compliqués (notamment limité le nombre de remplacement)

// strpos retourne la position d'un caractère dans une chaine (en commençant à 0)
echo strpos($chaine, "j");
echo strpos($chaine, "b");
echo strpos($chaine, "w");

if (strpos($chaine, "j")) {
    echo "Le 'j' a été trouvé dans ".$chaine."<br>";
}
if (strpos($chaine, "b") !== false) {
    echo "Le 'b' a été trouvé dans ".$chaine."<br>";
}
if (strpos($chaine, "w") !== false) {
    echo "Le 'w' a été trouvé dans ".$chaine."<br>";
}
// substr : retourne un segment d'une chaine en fonction de numéro de caractères
$bonjour = "bonjour";
$sub = substr($bonjour, 0, 3);
echo $sub."<br>";
$sub = substr($bonjour, 3);
echo $sub."<br>";
$sub = substr($bonjour, 3, 2);
echo $sub."<br>";
$sub = substr($bonjour, -1);
echo $sub."<br>";
$sub = substr($bonjour, -2, 1);
echo $sub."<br>";

// "salut" 4
// "coucou" 5
// "test" 3
$salut = "coucou";
$nbChars = strlen($salut)-1;
echo substr($salut, $nbChars)."<br>";

/**
 * Fonctions natives PHP
 * 2- Fonctions sur les tableaux
 */
// in_array permet de savori si une valeur se trouve dans un array
$tableau = ['bonjour', "salut", "au revoir"];
$var = "coucou";
if (in_array($var, $tableau)) {
    echo "coucou se trouve dans le tableau<br>";
}
else {
    echo "coucou ne se trouve pas dans le tableau<br>";
}
$var = "bonjour";
if (in_array($var, $tableau)) {
    echo "bonjour se trouve dans le tableau<br>";
}
else {
    echo "bonjour ne se trouve pas dans le tableau<br>";
}

// count : retourne le nombre d'éléments d'un tableau
$nbElements = count($tableau);
echo $nbElements."<br>";

// array_key_exists
$tableauAssociatif = ['cle1' => "valeur1", 'cle2' => 'valeur 2'];
if (array_key_exists('cle1', $tableauAssociatif)) {
    echo "La clé cle1 existe dans le tableau<br>";
}
if (array_key_exists('cle3', $tableauAssociatif)) {
    echo "La clé cle3 existe dans le tableau<br>";
}

// array_push : ajouter un élément dans un tableau en dernière position
array_push($tableauAssociatif, "coucou");

?>