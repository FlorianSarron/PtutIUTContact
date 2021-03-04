<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Notification\MailNotification;

class EmailController extends AbstractController
{
    /**
    * @Route("/email")
    */
    public function index(ContactRepository $contactRepository)
    {

        return $this->render('email/index.html.twig', [
            'contacts' => $contactRepository->findAll(),
        ]);
    }    
    /**
    * @Route("/sendEmail")
    */
    public function sendEmail(\Swift_Mailer $mailer){
            $text="Votre commande à bien été confirmée. \nVoici le contenu de votre commande: \n";
            $text=$text. "Vous devrez retirer la commande dans votre magasin ";
    
            $message = (new \Swift_Message('Hello Email'))
            ->setFrom('julien.rouilhac83@gmail.com')
            ->setTo('julien.rouilhac@etu.univ-lyon1.fr')
            ->setBody(
                $this->renderView(
                    '/email/test.html.twig'
                    //'emails/test.html.twig',
                ),
                'text/html'
            )
        ;
        $mailer->send($message);
        return $this->render('email/sendEmail.html.twig');
    }
}