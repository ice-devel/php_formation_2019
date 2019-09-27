<?php
    if (isset($_POST['btn_upload'])) {
        // pour l'upload d'un fichier le tableau GET/POST contient uniquement le nom du fichier
        // sur l'ordinateur client
        // $filenameClient = $_POST['photo']; // si le format a le bon enctype, la clé n'existe plus dans ces tableaux GET POST

        // il y a un autre tableau surperglobal en PHP pour la réception des fichiers uploadés
        $photo = $_FILES['photo'];

        // est-ce qu'un fichier a été choisi, et qu'il n'y a pas d'autres erreurs serveur
        if ($photo['name'] != "" && $photo['error'] == "0") {
            // si un formulaire contient un input type file, le fichier est déjà uploadé
            // quand on arrive ici, il est placé dans les fichiers de apache
            // il n'y a donc plus qu'à le déplacer vers la destination souhaitée
            $sourceFile = $photo['tmp_name'];
            $sourceFilename = $photo['name'];

            // générer un nouveau pour le fichier sur le serveur
            $uniq = uniqid(); // s'assurer d'avoir un nom de fichier (uniqid ne remplit cette fonction dans tous les cas)
            $pathInfo = pathinfo($photo['name']); // on passe par pathinfo pour récupérer l'extension
            $filename = $uniq.".".$pathInfo['extension'];

            // vérifier les configurations pour les tailles autorisées de fichier
            // php.ini : post_max_size, upload_max_filesize, max_file_uploads

            // et côté côté affiner avec :
            $sizeSourceFile = $photo['size'];
            if ($sizeSourceFile < 1 * 1024 * 1024) {
                // vérifier si le type de fichier correspond aux formats autorisés
                $typeMime = $photo['type'];
                if ($typeMime == "image/jpeg") {
                    move_uploaded_file($sourceFile, $filename);
                }
                else {
                    echo "Veuillez sélectionner une image JPG";
                }
            }
            else {
                echo "Fichier trop gros";
            }
        }
        else {
            echo "Veuillez sélectionner un fichier / Une erreur serveur est survenue";
        }


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
    <h1>Uploader un fichier</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="photo" />
        <input type="submit" value="uploader" name="btn_upload"/>
    </form>
</body>
</html>
