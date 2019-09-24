<?php
    /*
        I - HTML/CSS : langage client
        Le HTML / CSS / JAVASCRIPT peut être interprété par un navigateur

        II - PHP : langage serveur
        Il est exécuté sur un serveur, dans le but de renvoyer une réponse à un client

        Architecture web :
        Client -> (après correspondance avec DNS) serveur web (apache, nginx) -> PHP -> serveur web -> client

        Client : navigateur
        Serveur web : reçoit des requêtes HTTP (sur le port 80) HTTPS (sur le port 443), et y répond
        PHP : Si présence d'un fichier PHP sur le serveur web : PHP pourra le lire et l'interpréter

        IIa)
        - Configuration de apache : httpd.conf
        (DocumentRoot : répertoire racine, Listen : le port écouté par apache)
        - Configuration : php.ini
        - Configuration : my.ini
    */

    echo "Bonjour ";

    // traitement PHP pas affiché, mais quand même traité
    $i = 10;
    $i = $i + 15;
?>