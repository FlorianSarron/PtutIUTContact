<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Data\SearchData;
use App\Form\ContactType;
use App\Form\SearchForm;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

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
        $session = new Session();
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


        $session = $this->get('session');
        $session->set('contacts', $contacts);
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
     * @Route("/export")
     */
    public function export(ContactRepository $contactRepository): Response
    {
        $session = new Session();
        $FileCSV = " Nom; Prenom; Email; Ville; Code postal; Telephone; Fonction; Entreprise; Promotion;\n";
        if(empty($session->get('contacts'))){
            $session->set('contacts', $contactRepository->findall()); 
            foreach($session->get('contacts') as $contact){
                $FileCSV .= $contact->getNom() .";". $contact->getPrenom() .";". $contact->getEmail() .";" . $contact->getAdresse().";" . $contact->getVille() .";". $contact->getCodePostal() . ";". $contact->getTelephone() .";". $contact->getFonction() .";". $contact->getEntreprise() .";". $contact->getPromotion() .";\n";
            }
        }
        else{
            foreach($session->get('contacts') as $contact){
                $FileCSV .= $contact->getNom() .";". $contact->getPrenom() .";". $contact->getEmail() .";" . $contact->getAdresse().";" . $contact->getVille() .";". $contact->getCodePostal() . ";". $contact->getTelephone() .";". $contact->getFonction() .";". $contact->getEntreprise() .";". $contact->getPromotion() .";\n";
            }
        }
        return new Response(
               $FileCSV,
               200,
               [
                 'Content-Type' => 'application/vnd.ms-excel',
                 "Content-disposition" => "attachment; filename=export_contact.csv"
              ]
        );
    }

    /**
     * @Route("/import")
     */
    public function import(Request $request): Response
    {
        $upload     = new UploadData();
        $formUpload = $this->createForm(UploadType::class, $upload);
        $formUpload->handleRequest($request);
        if ($formUpload->isSubmitted() && $formUpload->isValid()) {

            $file     = $upload->getUpload();
            $fileName = $request->get('file');
            $file->move($this->getParameter('upload_directory'), $fileName);
            $upload->setUpload($fileName);

            $reader = Reader::createFromPath(__DIR__.'/'.$fileName);
            $result = $reader->fetchAssoc();
            foreach ($result as $row){
                $contact = new Contact();
                $contact
                    ->setNom($row['civility'])
                    ->setPrenom($row['last_name'])
                    ->setAdresse($row['first_name'])
                    ->setVille($row['email'])
                    ->setCodePostal($row['number'])
                    ->setTelephone($row['dealer'])
                    ->setEmail($row['dealer_zone'])
                    ->setFonction($row['dealer_code'])
                    ->setEntreprise($row['dealer_code'])
                    ->setPromotion($row['dealer_code'])
                ;
                $this->em->persist($cont);

            }
            $this->em->flush();
            $this->addFlash('success','Bien ajouté avec succès');
        }
        return $this->redirectToRoute('contact_index');
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
