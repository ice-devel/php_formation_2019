<?php

namespace App\Controller;


use App\Helper\Util;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app")
     */
    public function index(Util $util)
    {
        $title = "Hello salut les loulous ! hééé";

        /*
        $util = new Util();
        $clean = $util->slugify($title);
        */

        /*
        $util = $this->container->get('app.util');
        $clean = $util->slugify($title);
        */

        /* ça, pas besoin de le faire, le container de service le fait pour nous:
            $router = $this->container->get('router');
            $util = new Util($router);
        */
        $util->generateUrl();

        $response = $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
        ]);
        return $response;
    }

    /**
     * @Route("/coucou", name="coucou")
     */
    public function coucou() {
        // un controller doit renvoyer un ojbet Response
        $response = new Response();
        // echo "never"; on fait jamais ça
        // on set le contenu à afficher dans la propriété content de l'objet response
        $response->setContent("always");

        return $response;
    }

    /**
     * @Route("/html", name="html")
     */
    public function html() {
        // un controller doit renvoyer un ojbet Response
        $response = new Response();
        // $response->setContent("<!DOCTYPE html><html><head></head><body></body></html>"); // on fait jamais ça

        // on fait plutôt ça : faire appel à twig pour générer un template
        // on indique à la méthode render (fournie par le controller symfony) le chemin du template
        // qui débute par défaut au dossier "templates" situé à la racine du projet
        $content = $this->renderView('app/template.html.twig');
        // on met le html généré dans le "content" de l'objet response
        $response->setContent($content);

        return $response;
    }

    /**
     * @Route("/html2", name="html2")
     */
    public function html2() {
        // exactement la même chose que le controller au dessus mais en une ligne
        return $this->render('app/template.html.twig');
    }

    /**
     * @Route("/template-dynamique", name="template_dynamique")
     */
    public function templateDynamique() {
        // on peut passer des variables à twig pour les utiliser dans le template
        $now = new \DateTime();
        $nowChaine = $now->format('d/m/Y H:i:s');


        $users = ['fab', 'toto', 'caro', 'ade'];

        // on les passe à twig grâce à un tableau associatif : les clés seront des variables
        // utilisables dans le template
        return $this->render('app/template_dynamique.html.twig', [
            'nowChaine' => $nowChaine,
            'users' => $users
        ]);
    }
}
