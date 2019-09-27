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
            <h1>Ajouter un vélo</h1>

            <form action="" method="POST">
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" class="form-control" name="name"/>
                </div>

                <div class="form-group">
                    <label>Taille</label>
                    <input type="number" class="form-control" name="size"/>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" class="form-control" name="price" step="0.01"/>
                </div>

                <div class="form-group">
                    <label>Cadre</label>
                    <input type="radio" name="frame" value="<?php echo Velo::FRAME_MAN; ?>"/>Homme
                    <input type="radio" name="frame" value="<?php echo Velo::FRAME_WOMAN; ?>"/>Femme
                    <input type="radio" name="frame" value="<?php echo Velo::FRAME_MIXED; ?>"/>Mixte
                </div>

                <div class="form-group">
                    <input type="checkbox" name="suspension"/>
                    <label>Suspension</label>
                </div>

                <div class="form-group">
                    <input type="submit" name="btn_valid"/>
                </div>
            </form>
        </div>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>