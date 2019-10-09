<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MailController extends AbstractController
{
    /**
     * @Route("/mail", name="mail")
     */
    public function mail(\Swift_Mailer $mailer)
    {
        // en PHP sans bibliothèque :
        /*
        $headers = array(
            'From' => 'contact@formation-symfony.local'
        );
        mail("fab@mail.fr", "Coucou", "Salut comment va ?", $headers);
        */

        // envoi un mail : SwiftMailer
        $message = new \Swift_Message();
        $message->addFrom('contact@formation-symfony.local');
        $message->addTo('fab@mail.fr');
        $message->setSubject('Coucou');

        // le corps du mail peut être externalisé dans un template twig
        $body = $this->renderView('mail/welcome.html.twig', []);
        $message->setBody($body, 'text/html');

        // envoi du mail avec le service SwiftMailer
        $nbMailsSent = $mailer->send($message);

        // si vous voulez ajouté un fichier joint
        /*
         * $message->attach(\Swift_Attachment::fromPath('/var/www/monsite/photo.jpg'));
         */

        // la suite : pensez à configurer MAILER_URL, votre serveur SMTP, puis SPF/DKIM

        // vérifier si le mail a été envoyé
        if ($nbMailsSent > 0) {
            return new Response("Mail envoyé");
        }
        else {
            return new Response("Erreur d'envoi de mail");
        }
    }
}
