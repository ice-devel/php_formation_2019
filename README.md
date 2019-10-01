Symfony: Framework PHP

I - intro
- Développer avec des conventions que tous les développeur(se)s symfony respectent : un code organisé et propre.
Ce qui rend le code maintenable / évolutifs
- Plein d'outils à disposition pour éviter réinventer la roue
- Documentation en ligne complète et une communauté active (open source)

- Courbe d'apprentissage un peu plus longue mais pas significative dès le court terme
- Se maintenir à jour dans ses connaissances / compétences (Suivre la ROADMAP, voir les évolutions / suppressions)

II - installation
Installation : via composer : gestionnaire de dépendances (package/recipes) php
Comme tous les autres composants qu'on viendra greffer à une appli symfony

Installer PHP et mettre en variable environnement
Installer Composer et mettre variable environnement
lancer : composer create-project symfony/website-skeleton project_name

III - Architecture
Architecture Symfony 4
bin : deux applications php : console (pour lancer des commandes symfony) et phpunit (raccourci vers phpunit)
config : fichier de configuration symfony et packaes en YAML
public : le dossier qui contient le controller frontal (par lequel totues les requêtes passent)
        et les fichiers accessibles par le navigateur (assets)
src : code spécifique à votre application (là on va poser la plupart du temps)
templates: on met les vues (enn général templates html généré avec twig)
test : tests unitaires/fonctionnels avec phpunit
translations : fichiers de traduction (i18n)
var : fichiers dépendant du poste où le projet est exécuté. Cache (dev,test,prod) et Log
vendor: "bibliothèques" externes (auxquelles on ne touche jamais)

A la racine : .env qui définit vos variables d'environnement, et composer.json qui décrit les dépendances de votre projet

IV - utilisation de la console
Lancer des commandes développées avec symfony.
Un tas de commandes par défaut pour nous faciliter la tâche (des commandes pour
 la base de données, pour les controllers, pour les entités, etc.)
 
 Par exemple lançons :
 php bin/console make:controller
 pour générer un controller automatiquement
 
V - création d'un site vhost
a- Dans le fichier hosts de votre OS, créer un domaine qui pointe vers 127.0.0.1
b- créer le vhost correpondant dans apache, pour dire à apache vers quel site rediriger quand on vient de ce nom de domaine
Avec xampp par exemple, ajouter le vhost dans apache/conf/extra/httpd-vhost.conf
c- redémarrer apache

Par exemple :
<VirtualHost *:80>
    ServerName formation-symfony.dev
    ServerAlias www.formation-symfony.dev

    DocumentRoot "C:/xampp/htdocs/PHP/PHP5/public"
    <Directory "C:/xampp/htdocs/PHP/PHP5/public">
        AllowOverride All
        Order Allow,Deny
        Allow from All
    </Directory>

    ErrorLog "C:/logs/apache2/formation_symfony_error.log"
    CustomLog "C:/logs/apache2/formation_symfony_access.log" combined
</VirtualHost>

VI - création d'une page
1 - route : l'url de la page
2 - qui appelle un controller
3 - qui renvoie le template généré sous forme de Response
https://sdz-upload.s3.amazonaws.com/prod/upload/routeur_1.png

VII - doctrine (bdd)
1- créer la base :
    - on configure la variable DATABASE_URL dans .env
    - php bin/console doctrine:database:create
2- générer vos entités (ou créer les manuellement)
    - php bin/console make:entity
3- mettre à jour la base de données
    - php bin/console doctrine:schema:update --dump-sql
    - php bin/console doctrine:schema:update --force