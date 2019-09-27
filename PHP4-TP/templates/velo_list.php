<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container">
            <h1>Liste des vélos</h1>
            <table class="table">
                <thead>
                    <th>Id</th>
                    <th>Date de création</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Taille</th>
                    <th>Cadre</th>
                    <th>Suspension</th>
                    <th>Couleur</th>
                    <th>Actions</th>
                </thead>

                <tbody>
                <?php
                    foreach ($velos as $velo) {
                        if ($velo->getSuspension()) {
                            $suspension = "oui";
                        }
                        else {
                            $suspension = "non";
                        }

                        switch ($velo->getFrame()) {
                            case 0:
                                $frame = "Homme";
                                break;
                            case 1:
                                $frame = "Femme";
                                break;
                            case 2:
                                $frame = "Mixte";
                                break;
                        }

                        if ($velo->getColor() == null) {
                            $color = "";
                        }
                        else {
                            $color = $velo->getColor()->getName();
                        }

                        echo "<tr>
                                <td>".$velo->getId()."</td>
                                <td>".$velo->getCreatedAt()->format('d/m/Y H:i')."</td>
                                <td>".$velo->getName()."</td>
                                <td>".$velo->getPrice()."€</td>
                                <td>".$velo->getSize()."</td>
                                <td>".$frame."</td>
                                <td>".$suspension."</td>
                                <td>".$color."</td>
                                <td>
                                    <a href='delete.php?id=".$velo->getId()."' onclick=\"return confirm('Supprimer ?');\">Supprimer</a>
                                    <a href='update.php?id=".$velo->getId()."'>Modifier</a>
                                </td>
                               </tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>