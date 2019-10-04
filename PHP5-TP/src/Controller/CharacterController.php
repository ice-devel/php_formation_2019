<?php

namespace App\Controller;

use App\Entity\Character;
use App\Form\CharacterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CharacterController extends AbstractController
{
    /**
     * @Route("/character", name="character")
     */
    public function index(Request $request)
    {
        // création du form et association d'une instance
        $character = new Character();
        $form = $this->createForm(CharacterType::class, $character);

        // récupération des données
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($character);
                $em->flush();
                $this->addFlash('succes', 'Perso bien créé');
                return $this->redirectToRoute('character');
            }
            else {
                $this->addFlash('danger', 'Une erreur est survenue');
            }
        }

        return $this->render('character/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
