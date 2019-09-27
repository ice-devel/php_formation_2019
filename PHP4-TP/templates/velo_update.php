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
            <h1>Modifier un vélo</h1>

            <form action="" method="POST">
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $velo->getName(); ?>"/>
                </div>

                <div class="form-group">
                    <label>Taille</label>
                    <input type="number" class="form-control" name="size" value="<?php echo $velo->getSize(); ?>"/>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" class="form-control" name="price" step="0.01" value="<?php echo $velo->getPrice(); ?>"/>
                </div>

                <div class="form-group">
                    <label>Cadre</label>
                    <input type="radio" name="frame" value="<?php echo Velo::FRAME_MAN; ?>"
                                <?php if ($velo->getFrame() == Velo::FRAME_MAN) echo "checked"; ?>/>Homme

                    <input type="radio" name="frame" value="<?php echo Velo::FRAME_WOMAN; ?>"
                                <?php if ($velo->getFrame() == Velo::FRAME_WOMAN) echo "checked"; ?>/>Femme

                    <input type="radio" name="frame" value="<?php echo Velo::FRAME_MIXED; ?>"
                                <?php if ($velo->getFrame() == Velo::FRAME_MIXED) echo "checked"; ?>/>Mixte
                </div>

                <div class="form-group">
                    <select name="color" class="form-control">
                        <option value=''></option>
                        <?php
                            foreach ($colors as $color) {
                                if ($velo->getColor() != null && $color->getId() == $velo->getColor()->getId()) {
                                    $colorSelected = "selected";
                                }
                                else {
                                    $colorSelected = "";
                                }
                                echo "<option value='".$color->getId()."' ".$colorSelected." >".$color->getName()."</option>";
                            }
                        ?>
                    </select>
                </div>


                <div class="form-group">
                    <input type="checkbox" name="suspension" <?php if ($velo->getSuspension()) echo "checked"; ?>/>
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