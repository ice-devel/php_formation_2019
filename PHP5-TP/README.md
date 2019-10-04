1) Créer un projet symfony 4.3 avec composer dans votre htdocs
    composer create-project symfony/website-skeleton project_name
    composer require symfony/apache-pack
    
2) Créer un nouveau domaine dans votre host et rediriger le vers votre poste local :
    C:\System32\drivers\etc\host
    127.0.0.1   tp-symfony.local

3) Créer un nouveau vhost dans apache qui dirige le nouveau domaine vers la racine web de votre projet
        
    <VirtualHost *:80>
        ServerName tp-symfony.local
        DocumentRoot "C:/xampp/htdocs/PHP/PHP5-TP/public"
    </VirtualHost>

    Et on redémarre apache

4) Configurer une nouvelle base dans le .env et créer cette base
    DATABASE_URL=mysql://root@127.0.0.1:3306/tp_symfony
    php bin/console doctrine:database:create

5) Modélisez dans votre application l'objet Personnage et mettez à jour la bdd : 
    Nom
    Force (entier max 20)
    Vie (entier max 100)
    Armure (entier max 15)
    Description (text)
    
        php bin/console make:entity
       
        Et pour les contraintes :
        * @Assert\LessThanOrEqual(20)
        
        Mettre à jour la base : par exemple la commande
        php bin/console doctrine:schema:update --dump-sql
        php bin/console doctrine:schema:update --force

6) Ajouter des méthodes au Personnage :
    Attaquer (un autre personnage, qui retire à ce 2em personnage un nombre de point de vie correspondant à l'attaque du premier moins l'armure du 2em)
        Dans l'entity Character : public function attack()
    Regénerer (qui redonne au perso un nombre de points de vie compris entre 1 et 10)
        Dans l'entity Character : public function heal()
        
7) Créer une page pour ajouter un personnage en bdd via un formulaire
    php bin/console make:controller
    php bin/console make:form

8) Créer une page qui affiche (les propriétés) deux personnages aléatoires (un à  gauche de l'écran, un à droite)
Puis deux boutons pour chaque personnage (attaquer et regénerer), qui font chacun un appel au serveur pour effectuer l'action correspondante. Un appel serveur = une action. Réafficher donc ensuite la même page avec les deux mêmes perso mais avec leur vie mise à jour.
Servez-vous des sessions (doc symfony 🙂) pour enregistrez les id des perso choisis au début aléatoirement, jusque ce qu'un personnage n'ait plus de vie) 
C'est tout pour ce TP
