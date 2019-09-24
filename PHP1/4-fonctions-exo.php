<?php
/**
 * Les fonctions : exo
 *
 * 1- Ecrivez une fonction qui calcule l'age en fonction d'une année
 * - Utilisez cette fonction pour afficher un âge
 *
 * 2- Ecrivez une fonction qui calcule un âge reel en fonction d'une date
 * - $date = 20/10/2000 ou alors $jour = 20 $mois = 10 annee = 2000
 * - Utilisez cette fonction pour afficher un age
 *
 * $var = "05/08/2006" explode
 *
 * 3- ecrire la fonction isValidMonthlyPeriod()
 * qui est une fonction vérifie si deux dates représente un mois complet
 * renvoie true si oui, false sinon
 * 01/09/2010 - 30/09/2010 : true 01/01/2010 - 31/03/2010 : false
 **/

function calculAge($dateNaissance) {
    // la fonction date renvoie par défaut la date actuelle dans le format voulu
    // ici on ne récupère que l'année actuelle
    $anneeActuelle = date("Y");
    $age = $anneeActuelle - $dateNaissance;
    return $age;
}

$date = "1987";
echo calculAge($date)."<br>";



/* l'anniversaire n'est pas encore passé :
    - si le mois d'anniversaire est inférieur au mois actuel
    - ou si le mois anniversaire est le même que le mois actuel
            ET que le jour naissance est inférieur au jour actuel
*/
function calculAgeReel($dateNaissance) {
    $jourActuel = date("d");
    $moisActuel = date("m");
    $anneeActuelle = date("Y");

    $tableauDate = explode("/", $dateNaissance);
    $anneeNaissance = $tableauDate[2];
    $moisNaissance = $tableauDate[1];
    $jourNaissance = $tableauDate[0];

    $age = $anneeActuelle - $anneeNaissance;

    /*
    if ($moisNaissance > $moisActuel) {
        $age = $age - 1;
    }
    elseif ($moisNaissance == $moisActuel) {
        if ($jourNaissance > $jourActuel) {
            $age = $age - 1;
        }
    }
    */
    if ($moisNaissance > $moisActuel || $moisNaissance == $moisActuel && $jourNaissance > $jourActuel) {
        $age = $age - 1;
    }

    return $age;
}

$dateNaissance = "19/09/1987";
echo calculAgeReel($dateNaissance);

function isValidMonthlyPeriod($dateDebut, $dateFin) {
    // date debut : 01
    // date fin : 28,29,30,31
    // mois debut == mois fin
    // annee debut == annee de fin

    /*
    $dateDebutTab = explode("-", $dateDebut);
    $dateFinTab = explode("-", $dateFin);
    $isValid = false;
    if ($dateDebutTab[2] == "01") {
        if ($dateDebutTab[1] == $dateFinTab[1]) {
            if ($dateDebutTab[0] == $dateFinTab[0]) {
                $nbJoursMois = date('t', strtotime($dateDebut));
                $dateFinValid = $dateDebutTab[0]."-".$dateDebutTab[1]."-".$nbJoursMois;
                if ($dateFin == $dateFinValid) {
                    $isValid = true;
                }
            }
        }
    }
    */

    /*
    if ($dateDebutTab[2] == "01"
        && $dateDebutTab[1] == $dateFinTab[1]
        && $dateDebutTab[0] == $dateFinTab[0]
    ) {
        $nbJoursMois = date('t', strtotime($dateDebut));
        $dateFinValid = $dateDebutTab[0]."-".$dateDebutTab[1]."-".$nbJoursMois;
        if ($dateFin == $dateFinValid) {
            $isValid = true;
        }
    }
    */

    /*
    if (date('d', strtotime($dateDebut)) == "01"
        && date('m', strtotime($dateDebut)) == date('m', strtotime($dateFin))
        && date('Y', strtotime($dateDebut)) == date('Y', strtotime($dateFin))
        && date('t', strtotime($dateDebut)) == date('d', strtotime($dateFin))
    ) {
        $isValid = true;
    }
    */

    /*
    $isValid = false;
    if (date('d', strtotime($dateDebut)) == "01"
        && date('t-m-Y', strtotime($dateDebut)) == date('d-m-Y', strtotime($dateFin))
    ) {
        $isValid = true;
    }

    return $isValid;
    */

    return date('d', strtotime($dateDebut)) == "01"
        && date('t-m-Y', strtotime($dateDebut)) == date('d-m-Y', strtotime($dateFin));
}

if (isValidMonthlyPeriod('2017-02-01', '2017-02-29')) {
    echo "Le mois est complet<br>";
}
else {
    echo "Période invalide<br>";
}


/**
 * Exercices :
 * 1- créer une fonction qui met en majuscule la première lettre d'une chaine et le reste en minuscule
 * 2- fonction qui met une lettre sur deux en majuscule en commençant par une majuscule
 *         (une chaine en PHP est aussi considérée comme un tableau (array) de caractères)
 *
 */
$bonjour = "bonjour";
echo $bonjour[2]."<br>";

function capitalize($string) {
    $string = strtolower($string);
    //$string = strtoupper(substr($string, 0, 1)).substr($string, 1);
    $string = strtoupper($string[0]).substr($string, 1);

    return $string;

    // ou en une seule ligne :
    // return strtoupper($string[0]).strtolower(substr($string, 1));
}

/*
 * Bonjour je mappelle toto
 * 0123456789
 * 0123456 78 9
 */
function minMaj($string) {
    /*
    $string = strtolower($string);
    for ($i=0;$i<strlen($string);$i = $i + 2) {
        $string[$i] = strtoupper($string[$i]);
    }
    */

    $toUpper = true;
    for ($i=0;$i < strlen($string);$i++) {
        if ($string[$i] != " ") {
            if ($toUpper) {
                $string[$i] = strtoupper($string[$i]);
            }
            else {
                $string[$i] = strtolower($string[$i]);
            }

            /*
            if ($toUpper) {
                $toUpper = false;
            }
            else {
                $toUpper = true;
            }
            */
            $toUpper = !$toUpper;
        }
    }

    return $string;
}

function minMajCount($string) {
    $count = 0;
    for ($i=0;$i < strlen($string);$i++) {
        if ($string[$i] != " ") {
            if ($count % 2 == 0) {
                $string[$i] = strtoupper($string[$i]);
            }
            else {
                $string[$i] = strtolower($string[$i]);
            }

            $count++;
        }
    }

    return $string;
}

$chaine = "salut tout le monde";

echo minMaj($chaine).'<br>';
echo minMajCount($chaine).'<br>';

?>