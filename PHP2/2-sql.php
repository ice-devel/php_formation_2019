<?php
/*
 * Les requêtes SQL via PHP
 */
// ancienne méthode

/*
// connexion au serveur de BDD
mysql_connect('localhost', 'root', '');
// sélection de la bdd
mysql_select_db('formation_php');
// envoi d'une requête
$result = mysql_query('SELECT * FROM utilisateur');
*/

// méthode intermédiaire
// connexion
$connection = mysqli_connect('127.0.0.1', 'root', '', 'formation_php');
// requête
$result = mysqli_query($connection, 'SELECT * FROM utilisateur');
// récupération des résultats
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
// libération des ressources utilisés par les résultats
mysqli_free_result($result);
?>

<style>
    table {
        border-collapse: collapse;
    }
    table td {
        border: 1px solid;
    }
</style>
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

<?php
    // mysqli bonne manière
    $mysqli = new mysqli('127.0.0.1', 'root', '', 'formation_php');
    $result = $mysqli->query('SELECT * FROM utilisateur');
    $users = $result->fetch_all();
    $result->free_result();
?>

<?php
    // good version PDO top
    $db = new PDO('mysql:host=127.0.0.1;dbname=formation_php;charset=UTF8', 'root', '');
    $statement = $db->query('SELECT * FROM utilisateur');
    $users = $statement->fetchAll();
?>
