<?php
/*
 * Le passé des BDD : comment on faisait pour "persister"
 * Ecrire dans des fichiers puis lire ces fichiers
 */
// créer, ouvrir, écrire, fermer
file_put_contents("fichier.txt", "bonjour");

// étapes par étapes
$file = fopen('fichier-par-etapes.txt', "a");
fwrite($file, "coucou");
fclose($file);

// append avec une seule fonction
file_put_contents("fichier.txt", "bonjour2", FILE_APPEND);

// lire un fichier
$contenu = file_get_contents("fichier.txt");
echo $contenu;