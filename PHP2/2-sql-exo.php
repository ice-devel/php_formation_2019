<?php
    // initialiser le tableau d'utilisateur pour l'affichage de la page
    // lorsque le formulaire n'a pas été soumis : aucun utilisateur à afficher mais
    // variable $users nécessaire pour formulaire de la vue
    $users = [];

    if (isset($_GET['btn_search'])) {
        // formulaire soumis : on recherche les utilsiateurs correspondant aux critères

        // 1- récupération des valeurs du formulaire
        $name = filter_input(INPUT_GET, 'name');
        $birthday = filter_input(INPUT_GET,'birthday');
        // birthday est récupéré depuis un input type date : donc attention,
        // la date FR est automatiquement convertie en format SQL par le navigateur
        // et attention certains navigateurs ne prennent en compte ce type de champ (IE et SAFARI)

        // SELECT * FROM utilisateur
        // SELECT * FROM utilisateur WHERE name = ''
        // SELECT * FROM utilisateur WHERE birthday = ''
        // SELECT * FROM utilisateur WHERE name = '' AND birthday = ''


        /*
        $sql = "SELECT * FROM utilisateur";

        if ($name != null && $name != "" && $birthday != null && $birthday != "") {
            $sql = $sql." WHERE name = '".$name."' AND birthday = '".$birthday."'";
        }
        elseif ($name != null && $name != "") {
            // ou : if ($name) {}
            // version pas protégée : potentiellement la cible d'injection sql
            $sql = $sql." WHERE name = '".$name."'";
            // version protégée
            // $sql = $sql." WHERE name = '".str_replace("'", "\'", $name)."'";
        }
        elseif ($birthday != null && $birthday != "") {
            $sql = $sql." WHERE birthday = '".$birthday."'";
        }

        echo $sql."<br>";

        // exécution de la requête
        // 1- connexion bdd
        $db = new PDO('mysql:host=127.0.0.1;dbname=formation_php;charset=UTF8', 'root', '');
        // 2- envoi de la requête
        $statement = $db->query($sql);
        // 3 - récupération des résultats
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        */

        /*
         * Version protégée
         */
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

        // exécution de la requête
        // 1- connexion bdd
        $db = new PDO('mysql:host=127.0.0.1;dbname=formation_php;charset=UTF8', 'root', '');
        // 2- envoi de la requête
        $statement = $db->prepare($sql);
        $statement->execute($params);
        // 3 - récupération des résultats
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <br>
    Exercice :
    Créer un formulaire HTML de filtres, pour afficher tous les utilisateurs en BDD
    Selon des critères.
    Les filtres :
        - champ pour filtrer le nom de l'utilisateur
        - champ pour filter la date de naissance de l'utilisateur (format jj/mm/aaaa)

    Les champs doivent pouvoir se complèter avec un ET

    Lorsque l'on valide le formulaire, il faut afficher dans la page
    les utilisateurs qui correspondent à ces critères

    <form method="get" action="">
        <input type="text" name="name"/>
        <input type="date" name="birthday"/>
        <input type="submit" name="btn_search"/>
    </form>

    <table>
        <?php
            foreach ($users as $user) {
                echo "<tr>
                        <td>".$user['id']."</td>
                        <td>".$user['created_at']."</td>
                        <td>".$user['name']."</td>
                        <td>".$user['birthday']."</td>
                    </tr>";
            }
        ?>
    </table>
</body>
</html>