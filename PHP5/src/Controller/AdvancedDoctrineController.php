<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Article;
use App\Entity\Team;
use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class AdvancedDoctrineController extends AbstractController
{
    /**
     * @Route("/doctrine-advanced", name="doctrine_advanced")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('App:User');
        $user = $repo->find(1);
        $users = $repo->findAll();

        $user = $repo->findOneBy(['email' => 'fab@mail.fr', '']);
        $user = $repo->findOneBy(['birthday' => new \DateTime('2009-09-09')]);
        $user = $repo->findOneBy(['id' => 1]); // inutile car on a déjà le find pour l'id

        // findBy et findOneBy : on passe un tableau associatif en paramètre (les clés doivent être des propriétés existantes
        // de l'entité, et on met la valeur en bdd souhaitée en valeur (après la =>)
        $user = $repo->findOneBy([
            'name' => 'toto',
            'email' => 'fab@mail.fr',
            'points' => [50, 100] // OR
        ]);
        // SELECT * FROM user WHERE name = 'toto' AND email = 'fab@mail.fr' AND (points = 50 OR points = 100)

        $users = $repo->findBy([
            'name' => 'toto',
            'email' => 'fab@mail.fr',
            'points' => [50, 100] // OR
        ]);


        $user = $repo->findOneByName("toto");
        $users = $repo->findByName("toto");
    }

    /**
     * @Route("/doctrine-advanced-query", name="doctrine_advanced_query")
     */
    public function advancedQuery() {
        // quand on veut faire des requêtes un peu complexe, on va devoir créer l'objet Query
        // l'objet Query se construit avec d'un QueryBuilder
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('App:User');

        /** @var QueryBuilder $qb */
        // récupérer tous les users dont le nom commencent par "t"
        $qb = $repo->createQueryBuilder('u');
        $qb->select('u')
            ->where('u.name LIKE :name')
            ->setParameter('name', 't%')
        ;
        $query = $qb->getQuery();
        $users = $query->getResult();


        $qb = $repo->createQueryBuilder('u');
        $qb->select('u')
            ->where('u.name LIKE :name')
            ->orWhere('u.email = :email')
            ->orWhere('u.birthday <= :birthday')
            ->setParameter('name', 't%')
            ->setParameter('email', 'test@mail.fr')
            ->setParameter('birthday', new \DateTime('2018-12-31'))
        ;
        $query = $qb->getQuery();
        // var_dump($query->getDQL()); // obtenir la requête "DQL"
        $users = $query->getResult();

        // compter le nombre d'enregistrement dans une table
        $qb = $repo->createQueryBuilder('u');
        $qb->select('COUNT(u)');
        $query = $qb->getQuery();
        // scalarResult : quand il n'y a qu'une seule colonne retournée par la requête
        // singleScalarResult : quand il n'y a qu'une seule colonne retournée et un seul enregistrement par la requête
        $nbUsers = $query->getSingleScalarResult();

        // en déplacant la config du query builder dans le repo correspondant
        $nbUsers = $repo->countUsers();
        $users = $repo->findByNameOrEmailOrBirthday("f", "mail@mail.fr", new \DateTime('2008-12-31'));

        echo "<pre>";var_dump($nbUsers);echo "</pre>";
        echo "<pre>";var_dump($users);echo "</pre>";

        return new Response(0);
    }

    /**
     * @Route("/associated-entities", name="associated_entities")
     */
    public function addNewUser() {
        $em = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setName('tata');
        $user->setEmail('tata@test.fr');
        $user->setBirthday(new \DateTime());
        $user->setIsEnabled(true);

        // relation oneToMany : un user peut avoir plusieurs adresses
        // adresse 1
        $address = new Address();
        $address->setZipcode("59000");
        $address->setCity("Lille");
        $address->setNumber("59");
        $address->setStreet("rue coucou");
        // liaison avec le user
        $user->addAddress($address);

        // adresse 2
        $address = new Address();
        $address->setZipcode("62000");
        $address->setCity("Arras");
        $address->setNumber("32");
        $address->setStreet("rue salut");
        // liaison avec le user
        $user->addAddress($address);

        // relation manyToOne : un user a une seule équipe
        // $team = new Team(); // on associe le user a une team existante
        $team = $em->getRepository('App:Team')->find(1);

        // associer la team à l'utilisateur
        // $user->setTeam($team);
        // préférez le addQuelquechose(), car la bidirectionnalité (setQuelquechose()) est codée dedans
        // si vous avez utilisé le make:entity
        $team->addUser($user);

        $em->persist($user);

        /**
         * Pas besoin d'appeler un persist sur les adresses si et seulement si
         * la relation oneToMany dans User a été configuré pour "persister"
         * en cascade. Dans l'entité la configuration :
         * OneToMany(targetEntity="App\Entity\Address", mappedBy="user", cascade={'all'})
         *
         */
        //$em->persist($address);

        // Valider la transaction : s'assure que tous les persist et remove
        // précédent vont fonctionner. Si une seule requête n'est pas bonne,
        // l'ensemble est annulé

        $em->flush();

        // les id des nouvelles entités sont disponibles après avoir été persistée en bdd
        // $user->getId() retournera le nouvel ID

        return $this->render('advanced-doctrine/associated_entities.html.twig',
            ['user' => $user]
        );
    }

    /**
     * @Route("/associated-entities/get-one-user", name="associated_entities_get_one_user")
     */
    public function getOneUser() {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App:User')->find(23);

        return $this->render('advanced-doctrine/associated_entities.html.twig',
            ['user' => $user]
        );
    }
}
