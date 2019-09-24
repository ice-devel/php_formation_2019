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
                border-collapse : collapse;
            }
            table td {
                border:1px solid;
                padding:7px;
            }
        </style>
    </head>

    <body>
        <?php
            include '5-menu.html';

            // la différence entre require et include est le niveau d'erreur
            // généré si le fichier n'est pas trouvé
            // include : warning / required : fatal error (erreur bloquante)
            require '5-menu.html';

            /*
             * include_once : regarde si le fichier à déjà inclus
             * require_once : regarde si le fichier à déjà inclus
             * et ne l'inclus pas si c'est le cas
             */
        ?>

        Bonjour nous sommes le
        <?php
            echo date("d/m/Y");
        ?>

        <br>
        Et il est :
        <?php
            echo date("H:i");
        ?>
        <br>

        Attention : les fichiers peuvent mélanger html et php,
        mais doivent obligatoirement avoir l'extension .php.

        <?php
        $users = [];

        $user = [];
        $user['id'] = 1;
        $user['name'] = "Toto";
        $user['birthday'] = "10/02/2001";
        $users[] = $user;

        $user = [];
        $user['id'] = 2;
        $user['name'] = "Dupond";
        $user['birthday'] = "03/06/1995";
        $users[] = $user;

        echo "<pre>";
        var_dump($users);
        echo "</pre>";
        ?>

        <table>
            <?php
                foreach ($users as $user) {
                    echo "<tr>
                             <td>".$user['id']."</td>
                             <td>".$user['name']."</td>
                             <td>".$user['birthday']."</td>
                         </tr>";
                }
            ?>
        </table>
    </body>
</html>