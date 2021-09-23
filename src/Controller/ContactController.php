<?php

namespace App\Controller;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController {
    /**
     * @Route("/mail", name="envoiemail")
     */
    public function envoyerMail(Request $request, MailerInterface $mi) {

        $email = new Email;
        $formulaire = $this->createForm(EleveType::class, $email);
        $formulaire->handleRequest($request);
        
        if ($formulaire->isSubmitted() && $formulaire->isValid()) {

        $email
            ->from($formulaire->getData()['mail'])
            ->to('maxime.lopes19@gmail.com')
            ->subject($formulaire->getData()['objet'])
            ->text($formulaire->getData()['corpsMail']);

        $mi->send($email);

        return $this->redirectToRoute('accueil');
        }
        else{
            return $this->render('formulaire.html.twig', [
                'titre' => 'Envoyer un mail',
                'form' => $formulaire->createView()
            ]);
        }
    }
}