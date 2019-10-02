<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class UserFormController extends AbstractController
{
    /**
     * @Route("/userform/create", name="user_form_create")
     */
    public function create(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // 1- instancier un usertest
        $user = new User();
        // si on veut mettre des valeurs dans le formulaire, c'est l'entity qu'on modifie
        // le formulaire html va automatiquement affiché les champs aavec des valeurs par défaut
        // correspondant aux valuers de l'entity
        $user->setIsEnabled(true);

        // 2- cette instance, on l'associe au formulaire, pour que le formulaire puisse
        // gérer les valeurs des propriétés de cet objet
        $form = $this->createForm(UserType::class, $user);

        // 3- passer la requête au composant form
        $form->handleRequest($request);

        // 4- on checke si le formulaire a été soumis
        if ($form->isSubmitted()) {
            // 5- on checke si le formulaire est valide
            if ($form->isValid()) {
                $em->persist($user);
                $em->flush();
                // message flash : message en session destiné à n'être affiché qu'une seule fois
                $this->addFlash('success', 'Utilisateur bien enregistré');

                // on peut rediriger vers une autre page de cette manière
                // return $this->redirectToRoute('user_list');
            }
            else {
                $this->addFlash('danger', 'Le formulaire n\'est pas valide');
            }
        }

        // on passe la vue du formulaire au template
        return $this->render('userform/create.html.twig', [
            'formUser' => $form->createView(),
            'user' => $user
        ]);
    }

    /**
     * @Route("/userform/create-old", name="user_form_create_old")
     */
    public function createOld(Request $request)
    {
        /*
         * CARREMENT BOUH : plus jamais
         */
        if (isset($_POST['btn_create_user'])) {
            $name = filter_input(INPUT_POST, 'name');
            $email = filter_input(INPUT_POST, 'email');
            $birthday = filter_input(INPUT_POST, 'birthday');
        }

        /*
         * BIEN BOUH : mais pourquoi pas dans certains cas
         */
        if (isset($_POST['btn_create_user'])) {
            /*
             * récupérer les données post : $request->request
             * récupérer les données get : $request->query
             */
            $name = $request->request->get('name');
            $email = $request->request->get('email');
            $birthday = $request->request->get('birthday');

            /*
             * la suite avec les entités
             */
            $user = new User();
            $user->setName($name);

            /*
             * enregistrement
             */
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        return $this->render('userform/create_old.html.twig');
    }

    /**
     * @Route("/userform/update/{id}", name="user_form_update")
     */
    public function update(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        // 1- récupérer un usertest
        $user = $em->getRepository('App:User')->find($id);

        // 2- cette instance, on l'associe au formulaire, pour que le formulaire puisse
        // gérer les valeurs des propriétés de cet objet
        $form = $this->createForm(UserType::class, $user);

        // 3- passer la requête au composant form
        $form->handleRequest($request);

        // 4- on checke si le formulaire a été soumis
        if ($form->isSubmitted()) {
            // 5- on checke si le formulaire est valide
            if ($form->isValid()) {
                $em->persist($user);
                $em->flush();
                // message flash : message en session destiné à n'être affiché qu'une seule fois
                $this->addFlash('success', 'Utilisateur bien modifié');

                // on peut rediriger vers une autre page de cette manière
                // return $this->redirectToRoute('user_list');
            }
            else {
                $this->addFlash('danger', 'Le formulaire n\'est pas valide');
            }
        }

        // on passe la vue du formulaire au template
        return $this->render('userform/create.html.twig', [
            'formUser' => $form->createView(),
            'user' => $user
        ]);
    }
}
