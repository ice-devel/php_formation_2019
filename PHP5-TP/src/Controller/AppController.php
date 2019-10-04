<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/fight", name="fight")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();

        // est-ce qu'un combat est en cours ? on regarde en session
        if ($session->has('character1')) {
            $id1 = $session->get('character1');
            $id2 = $session->get('character2');
            $character1 = $em->getRepository('App:Character')->find($id1);
            $character2 = $em->getRepository('App:Character')->find($id2);
        }

        // sinon commencer combat
        else {
            // récupérer deux perso aléatoirement
            // 1- on récupère tous les perso et on choisis deux
            $characters = $em->getRepository('App:Character')->findAll();
            $nbCharacters = count($characters);

            if ($nbCharacters > 1) {
                $perso1Num = rand(0, $nbCharacters-1);
                do {
                    $perso2Num = rand(0, $nbCharacters-1);
                } while ($perso2Num == $perso1Num);

                $character1 = $characters[$perso1Num];
                $character2 = $characters[$perso2Num];

                // mettre en session les id des perso, grâce à l'objet request
                $session->set('character1', $character1->getId());
                $session->set('character2', $character2->getId());
            }
            else {
                $this->addFlash('danger', 'Pas assez de persos');
                $character1 = null;
                $character2 = null;
            }
        }

        return $this->render('app/index.html.twig', [
            'character1' => $character1,
            'character2' => $character2
        ]);
    }

    /**
     * @Route("/attack/{character1Id}/{character2Id}", name="attack")
     */
    public function attack($character1Id, $character2Id) {
        $em = $this->getDoctrine()->getManager();
        $character1 = $em->getRepository('App:Character')->find($character1Id);
        $character2 = $em->getRepository('App:Character')->find($character2Id);

        // on peut vérifier que les deux persos existent en base
        // on peut vérifier que les deux persos sont bien ceux en train de combattre (en session)

        // le perso 1 attaque le perso2
        $character1->attack($character2);
        //on enregistre la nouvelle du perso2 en bdd
        $em->flush();
        $this->addFlash('success', $character1->getName(). " attaque ".$character2->getName());

        return $this->redirectToRoute('fight');
    }

    /**
     * @Route("/heal/{characterId}", name="heal")
     */
    public function heal($characterId) {
        $em = $this->getDoctrine()->getManager();
        $character = $em->getRepository('App:Character')->find($characterId);
        $character->heal();
        $em->flush();

        return $this->redirectToRoute('fight');
    }
}
