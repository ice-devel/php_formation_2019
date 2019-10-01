<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/create", name="user_create")
     */
    public function create()
    {
        $user = new User();
        $user->setName("toto");
        $user->setPoints(150);
        $user->setBirthday(new \DateTime("2019-08-08"));
        $user->setEmail("fab@mail.fr");
        $user->setIsEnabled(false);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->render('user/index.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/user/read/{id}", name="user_read")
     */
    public function read($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App:User')->find($id);

        if ($user == null) {
            throw new NotFoundHttpException();
        }

        return $this->render('user/index.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/user/update/{id}", name="user_update")
     */
    public function update($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App:User')->find($id);

        if ($user == null) {
            throw new NotFoundHttpException();
        }

        $user->setEmail("newmail@coucou.fr");

        $em->flush();

        return $this->render('user/index.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/user/delete/{id}", name="user_delete")
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App:User')->find($id);

        if ($user == null) {
            throw new NotFoundHttpException();
        }

        $em->remove($user);
        $em->flush();

        return new Response("User supprimé");
    }
}
