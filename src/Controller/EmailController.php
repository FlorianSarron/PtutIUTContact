<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use App\Form\EmailType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Notification\MailNotification;

class EmailController extends AbstractController
{
    /*private $mailer;

    public function __construct(MailerInterface $mailer){
        $this->mailer=$mailer;
    }*/
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
    public function sendEmail(Request $request){
        if(!empty($request->request->get('message'))){
            $email = (new Email())
            ->from('floriansarrondev@gmail.com')
            ->to('julien.rouilhac83@gmail.com')
            ->subject('Service client')
            ->text($request->request->get('message'));
            //$this->mailer->send($email);
        }
        return $this->render('email/sendEmail.html.twig');
    }
}