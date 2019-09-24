<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
        }
        table td, table th{
            border: 1px solid;
        }
    </style>
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
    <tr>
        <th>Id</th>
        <th>Created At</th>
        <th>Name</th>
        <th>Birthday</th>
        <th>Points</th>
        <th>Zipcode</th>
    </tr>
    <?php
    foreach ($users as $user) {
        echo "<tr>
                <td>".$user->getId()."</td>
                <td>".$user->getCreatedAt()."</td>
                <td>".$user->getName()."</td>
                <td>".$user->getBirthday()."</td>
                <td>".$user->getPoints()."</td>
                <td>".$user->getZipcode()."</td>
            </tr>";
    }
    ?>
</table>
</body>
</html>