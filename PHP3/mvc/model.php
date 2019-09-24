<?php
// ce fichier n'est pas un "model" c'est juste ce qui s'en rapproche le plus dans cet exo

function getUsers($name, $birthday) {
    // 2- création requête dynamique
    $sql = "SELECT * FROM utilisateur";
    $params = [];
    if ($name != null && $name != "" && $birthday != null && $birthday != "") {
        $sql = $sql." WHERE name = :name AND birthday = :birthday";
        $params[':name'] = $name;
        $params[':birthday'] = $birthday;
    }
    elseif ($name != null && $name != "") {
        $sql = $sql." WHERE name = :name";
        $params[':name'] = $name;
    }
    elseif ($birthday != null && $birthday != "") {
        $sql = $sql." WHERE birthday = :birthday";
        $params[':birthday'] = $birthday;
    }

    echo $sql."<br>";

// 3- exécution de la requête
// 3.1- connexion bdd
    $db = new PDO('mysql:host=127.0.0.1;dbname=formation_php;charset=UTF8', 'root', '');
// 3.2- envoi de la requête
    $statement = $db->prepare($sql);
    $statement->execute($params);
// 3.3 - récupération des résultats
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $users;
}
