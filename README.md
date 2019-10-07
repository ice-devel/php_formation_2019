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
    
VIII - générer des urls
En twig : fonction path() avec deux paramètres :
nom de la route et paramètres de la route

Voir templates/doctrine/read_all.html.twig

Exercice :
Codez le CRUD pour des utilisateurs :
    - créez 4 pages (route/controller/template)
        - 1 page pour créer un utilisateur : crée un user puis l'affiche
        - afficher : récupère un user puis l'affiche
        - mettre à jour : modifie un user puis l'affiche
        - supprimer : supprime un user + message confirmation ou 404
Il faut gérer pour les utilisateurs :
    - id
    - nom (chaine)
    - email (chaine)
    - date de naissance (date)
    - compte activé / désactivé
    - date d'insertion en bdd
    - points (entier)
1- Génération de l'entité
2- mise à jour de la base
3- création du controller
4- création des routes
5- création des templates

Correction : voir UserController.php

IX - Les Formulaires
"from scratch" on codait le formulaire html <form> puis on récupérait sur la page destination
les données saisies, pour ensuite les contrôler et les envoyer en base
Avec symfony, on a un composant "Form" qui va nous permettre de simplifier la tâche, et pourquoi pas de créer
des formulaires réutilisables.

On va donc générer un formulaire (c'est une classe), un FormType.
Un FormType est associé à une entité en particulier.
Commande pour générer un FormType :
php bin/console make:form

On peut ensuite utiliser dans nos controllers par exemple pour le crud.

Si besoin, on peut carrément générer un crud entier (controller, templates, formtype)
en ligne de commande :
php bin/console make:crud

On met les contraintes de validation sur les propriétés de l'entité elle-même :
https://symfony.com/doc/current/reference/constraints.html
Ainsi le $form->isValid() renverra faux si les valeurs possibles ne sont pas respectées

X - les services

XI - query builder
Si les méthodes find, findAll, findBy, findOneBy ne suffisent pas,
car le besoin est plus complexe, on va créer une "Query" nous-même grâce l'objet
QueryBuilder.
On peut avoir accès à ce queryBuilder dans un controller mais sa place se trouve
dans les Repository correspondant : UserRepository pour l'entité User

XII - Les transactions :
Les transactions sont automatiques avec Doctrine, c'est à dire qu'on envoie vraiment toutes 
requêtes demandées (avec persist, remove) avec un flush
- START TRANSACTION;
- requête 1
- requête 2
- requête 3

- Si les trois requêtes renvoie vrai :
- COMMIT;

- Sinon on annule tout :
- ROLLBACK;

Doctrine détecte si la base supporte les transactions,
et ne les utilise pas si ce n'est pas le cas

XIII - associations entre entity :
- oneToMany <=> manyToMany
- oneToOne
- manyToMany

On peut générer ces associations également avec la commande :
php bin/console make:entity
Il suffit de saisir le nom de l'entité à modifier

Par défaut, doctrine fait du lazy loading pour les entités :
C'est à dire que lorsque vous récupérer un user, vous ne récupérez pas encore ses adresses.
Mais dès que vous faites par exemple, $user->getAddresses(), doctrine déclenche automatiquement
une requête SQL pour charger les entités Address correspondantes

XIV - associations entre entity dans un formulaire :
- manyToOne:
    - sélectionner une entrée existante : il suffit de mettre le nom de la propriété, le formulaire sera chargé automatiquement
avec les entités existantes en base
    - créer une nouvelle : il faut un FormType "embbed" pour l'entité associée
    
- oneToMany:
    - sélectionner une entrée existante : il suffit de mettre le nom de la propriété, le formulaire sera chargé automatiquement
      avec les entités existantes en base (mais avec un select multiple)
    - créer une nouvelle : il faut un FormType "embbed" pour l'entité associée
    
Attention :
- pour l'ajout dans la collection, pensez à by_reference => false
- pour la suppression : orphanRemoval dans l'annotation de l'entité

XV - Cycles de vie d'une entité
Doctrine déclenche des évenements lorsqu'elle travaille avec des entités
- prePersist / postPersist
- preUpdate / postUpdate
- preRemove / postRemove