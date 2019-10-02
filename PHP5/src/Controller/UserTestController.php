<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class UserTestController extends AbstractController
{
    /**
     * @Route("/usertest/create", name="usertest_create")
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

        return $this->render('usertest/index.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/usertest/read/{id}", name="usertest_read")
     */
    public function read($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App:User')->find($id);

        if ($user == null) {
            throw new NotFoundHttpException();
        }

        return $this->render('usertest/index.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/usertest/update/{id}", name="usertest_update")
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

        return $this->render('usertest/index.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/usertest/delete/{id}", name="usertest_delete")
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
