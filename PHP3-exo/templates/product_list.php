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
            <h1>Liste des produits</h1>
            <table class="table">
                <thead>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Date de création</th>
                    <th>En ligne</th>
                    <th>Actions</th>
                </thead>

                <tbody>
                    <?php
                        foreach ($products as $product) {
                            /*
                            if ($product->getIsOnline() == 1) {
                                $isOnline = "oui";
                            }
                            else {
                                $isOnline = "non";
                            }
                            */

                            // ou en ternaire
                            $isOnline = ($product->getIsOnline() == 1) ? "oui" : "non";

                            echo "
                                <tr>
                                    <td>".$product->getId()."</td>
                                    <td>".$product->getName()."</td>
                                    <td>".$product->getPrice()."</td>
                                    <td>".$product->getCreatedAt()->format("d/m/Y H:i:s")."</td>
                                    <td>".$isOnline."</td>
                                    <td><a href='delete.php?id=".$product->getId()."'>Supprimer</a></td>
                                </tr>
                            ";
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>