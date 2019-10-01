<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class DoctrineController extends AbstractController
{
    /**
     * @Route("/doctrine", name="doctrine")
     */
    public function index()
    {
        $article = new Article();
        $article->setTitle("Titre article 1");
        $article->setDescription('Description de l\'article 1');
        $article->setIsOnline(true);
        $article->setCreatedAt(new \DateTime());

        return $this->render('doctrine/index.html.twig', ['article' => $article]);
    }

    /**
     * @Route("/doctrine/create", name="doctrine_create")
     */
    public function create() {
        // persister une entité en bdd

        // 1- avoir une instance d'une entité
        $article = new Article();
        $article->setTitle("Titre articl'e bdd");
        $article->setDescription("Description article bdd");
        $article->setCreatedAt(new \DateTime());
        $article->setIsOnline(true);

        // 2- récupérer le manager de l'ORM
        $em = $this->getDoctrine()->getManager();

        // 3- dire à doctrine de gérer l'entité
        $em->persist($article);

        // 4- valider l'enregistrement de l'article en bdd
        $em->flush();

        return new Response("Article bien créé");
    }

    /**
     * @Route("/doctrine/read", name="doctrine_read")
     */
    public function read() {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('App:Article')->find(4);

        // générer une 404 si aucun article en base ne correspond
        if ($article == null) {
            throw new NotFoundHttpException();
        }

        return $this->render('doctrine/index.html.twig', ['article' => $article]);
    }

    /**
     * @Route("/doctrine/update", name="doctrine_update")
     */
    public function update() {
        // 1- récupérer l'objet
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('App:Article')->find(1);

        // générer une 404 si aucun article en base ne correspond
        if ($article == null) {
            throw new NotFoundHttpException();
        }

        // 2- modifier les valeurs
        $article->setTitle("Titre modifié 2eme fois");
        $article->setIsOnline(false);

        // 3- dire au manager d'envoyer les modifs en bdd
        // $em->persist($article);
        $em->flush();

        return new Response("Article bien modifié");
    }

    /**
     * @Route("/doctrine/delete", name="doctrine_delete")
     */
    public function delete() {
        // 1- récupérer l'objet
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('App:Article')->find(1);

        // générer une 404 si aucun article en base ne correspond
        if ($article == null) {
            throw new NotFoundHttpException();
        }

        // 2- dire à doctrine de supprimer cet objet lors du prochain flush
        $em->remove($article);

        // 3- flusher
        $em->flush();

        return new Response("Article bien supprimé");
    }
}
