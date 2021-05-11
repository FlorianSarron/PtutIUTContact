<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Data\SearchData;
use App\Form\ContactType;
use App\Form\SearchForm;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/", name="contact_index", methods={"GET"})
     */
    public function index(ContactRepository $contactRepository,Request $request): Response
    {
        $data=new SearchData();
        $form=$this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        $contacts = $contactRepository->findSearch($data);

        $contactsMail = [];
        foreach($contacts as $contact) {
            $mail = $contact->getEmail();
            array_push($contactsMail, $mail);
        }

        $request->query->set('mails', $contactsMail);


        return $this->render('contact/index.html.twig', [
            'contacts' => $contacts,
            'nbContacts' => count($contacts),
            'contactsMail' => $contactsMail,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/sendMail", name="contact_sendMail", methods={"GET","POST"})
     */
    public function sendMail(Request $request, ContactRepository $contactRepository): Response
    {
        $contactsMail = $request->query->get('mails');
        
        $contacts = $contactRepository->findBy(['email' => $contactsMail]);

        return $this->render('contact/sendMail.html.twig', [
            'contactsMail' => $contactsMail,
            'contacts' => $contacts
        ]);
    }

    /**
     * @Route("/new", name="contact_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('contact_index');
        }

        return $this->render('contact/new.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contact_show", methods={"GET"})
     */
    public function show(Contact $contact): Response
    {
        return $this->render('contact/show.html.twig', [
            'contact' => $contact,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contact_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contact $contact): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contact_index');
        }

        return $this->render('contact/edit.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contact_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Contact $contact): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contact);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contact_index');
    }
}
