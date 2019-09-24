<?php
/*
 * Fonctions SQL : comme en PHP, on peut utilsier des fonctions
 * directement dans les requêtes SQL
 */

/*
 * Fonctions scalaires : faire un traitement sur un ou des champs
 * de tous les enregistrements correspondant à la requête
 */
// Mettre en majuscule : UPPER va renvoyer ici dans la colonne name
// tous les caractères en majuscule
$sql = "SELECT id, created_at, UPPER(name), birthday FROM utilisateur";
$sql = "SELECT * FROM utilisateur WHERE UPPER(name) = 'JOHN2'"; // si la base est sensible à la casse

// Mettre en minuscule
$sql = "SELECT id, created_at, LOWER(name), birthday FROM utilisateur";

// Récupérer la longueur d'une chaine
$sql = "SELECT id, created_at, name, LENGTH(name), birthday FROM utilisateur";
$sql = "SELECT * FROM utilisateur WHERE LENGTH(name) = 5";

// Arrondi
$sql = "SELECT ROUND(5.5)";
$sql = "SELECT ROUND(5.53, 1)"; // avec précision du nombre de chiffre après la virgule
$sql = "SELECT ROUND(5.53, 2)"; // avec précision du nombre de chiffre après la virgule

// Fonctions d'agrégat : renvoi un seul résultat sur toute une colonne
// Compter le nombre d'enregistrement correspondant à la requête
$sql = "SELECT COUNT(*) FROM utilisateur";

$sql = "SELECT MAX(created_at) FROM utilisateur";
$sql = "SELECT MIN(created_at) FROM utilisateur";
$sql = "SELECT AVG(points) FROM utilisateur WHERE zipcode='59000'";
$sql = "SELECT SUM(points) FROM utilisateur WHERE zipcode='59000'";

// DISTINCT : renvoyer des enregistrements dédoublonnés : le distinct agit uniquement
// sur les colonnes sélectionnées dans le SELECT pour savoir si il faut dédoublonner
$sql = "SELECT DISTINCT birthday FROM utilisateur";

$sql = "SELECT MAX(points) FROM utilisateur";

// Clauses particulières : GROUP BY et HAVING
// ceci ne retourne qu'un seul enregistrement
$sql = "SELECT SUM(points) FROM utilisateur";

// imaginons nous voulons la somme des points par ville
$sql = "SELECT SUM(points) FROM utilisateur GROUP BY zipcode";

// imaginons nous voulons la somme des points des trois premières villes
// grouper, trier par score du + grand au + petit et limité pour n'obtenir
// qu'un nombre d'enregistrement précis
$sql = "SELECT zipcode, SUM(points) AS nombre_points
        FROM utilisateur
        GROUP BY zipcode
        ORDER BY nombre_points
        DESC LIMIT 2";

// nombre de points par ville ET par équipe
$sql = "SELECT zipcode, equipe, SUM(points) AS nombre_points
        FROM utilisateur
        GROUP BY zipcode, equipe
        ORDER BY nombre_points";

// nombre de points par ville ET par équipe avec comptabilisation du nombre de joueurs par groupement
$sql = "SELECT zipcode, equipe, SUM(points) AS nombre_points, COUNT(id) AS nombre_joueurs
        FROM utilisateur
        GROUP BY zipcode, equipe
        ORDER BY nombre_points";

// HAVING : sert à mettre une condition, non pas sur un enregistrement,
// mais sur un groupement d'enregistrements
// nombre de points par ville en n'affichant uniquement les villes qui ont + de 50 points
$sql = "SELECT zipcode, SUM(points) AS nombre_points, COUNT(id) AS nombre_joueurs
        FROM utilisateur
        GROUP BY zipcode
        HAVING SUM(points) > 50
        ORDER BY nombre_points";

// à la différence du where qui va filtrer quels enregistrements doivent faire partie
// des groupements. Exemple : somme des points par ville qui ont plus de 50 points
// en ne comptant les points que des personnes nées à partir de 2019
$sql = "SELECT zipcode, SUM(points) AS nombre_points, COUNT(id) AS nombre_joueurs
        FROM utilisateur
        WHERE birthday >= '2019-01-01'
        GROUP BY zipcode
        HAVING SUM(points) > 50
        ORDER BY nombre_points";


/*
 * Jointures
 * Table oneToMany - manyToOne
 */
/**
 * On modèlise dans la base deux tables liées entre elles de plusieurs façon :
 * oneToMany : 1 vers n enregistrements
 * utilisateur (1) <-> phone (n)
 * Ce cas se traduit par l'ajout d'une deuxième table "phone", qui possède une clé étrangère
 * faisant référence à la clé primaire dans la table utilisateur
 */

/**
 * Maintenant sélectionner des données en liant les tables dans la requêtes
 * avec ce qu'on appelle les jointures : pour récupérer à la fois les données utilisateur
 * et les téléphones qui leur sont liés
 *
 */

// 1- Jointure interne : INNER JOIN
// Ce type de jointure ne renvoie que les enregistrements où la condition de jointure est
// satisfaite. Dans notre exemple, les utilisateurs qui n'ont pas de téléphone ne ressortiront pas
$sql = "SELECT * FROM `utilisateur` U INNER JOIN phone P ON P.id_user = U.id";

// 2- Jointure Externe : LEFT/RIGHT OUTER JOIN
// Ce type de jointure renvoie tous les éléments de la table priorisée par LEFT ou RIGHT
// dans notre exemple, LEFT priorise la table à gauche "utilisateurs", et donc tous les
// utilisateurs vont ressortir au moins une fois, et ressortiront plusieurs si ils ont plusieurs
// numéros de téléphone. Si ils n'ont aucun numéro, ils ressortiront une seule fois et
// les colonnes correspondant à la table phone auront toutes la valeur NULL
$sql = "SELECT * FROM `utilisateur` U LEFT OUTER JOIN phone P ON P.id_user = U.id";

// dans le cas inverse si on priorise phone, tous les numéros de téléphone vont ressortir
// même si ils ne sont pas liés à un utilisateur
$sql = "SELECT * FROM `utilisateur` U RIGHT OUTER JOIN phone P ON P.id_user = U.id";

/**
 * Sous requêtes : des requêtes dans des requêtes
 */
// obtenir les utilisateurs qui ont le plus de points (égalité possible)
// puisque ceci est impossible :
// - SELECT * FROM utilisateur WHERE points = MAX(points) : une fonction d'agrégat
// ne peut pas être utilisée comme condition dans le where (uniquement
// dans le having d'un groupement)
// puisque ceci n'est pas suffisant :
// - SELECT MAX(points) FROM utilisateurs : nous ne savons pas qui est/sont les premiers
// et surtout, même si on rajoute la colonne "id" dans le SELECT, nous ne saurons pas
// si il y a égalité entre plusieurs utilisateurs,
// la solution devient la sous-requête :
$sql = "SELECT * FROM utilisateur WHERE points = (SELECT MAX(points) FROM utilisateur)";