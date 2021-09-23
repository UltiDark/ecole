<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Form\Type\EleveType;
use App\Repository\EleveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EleveController extends AbstractController
{
    /**
    * @Route("/eleve", name="eleve")
    */
    public function afficheListeeleve(EleveRepository $repository){
        $eleves = $repository->findAll();
        return $this->render('personne.html.twig',[
            "titre" => 'Elèves',
            "personnes" => $eleves
        ]);
    }

    /**
    * @Route("/eleve/create", name="createeleve")
    */
    public function createEleve(Request $request, EntityManagerInterface $em){
        $eleve = new Eleve;
        $formulaire = $this->createForm(EleveType::class, $eleve);
        $formulaire->handleRequest($request);


        if ($formulaire->isSubmitted() && $formulaire->isValid()) {

            $em->persist($eleve);
            $em->flush();

            return $this->redirectToRoute('accueil');
        }
        else
        {
            return $this->render('formulaire.html.twig', [
                'titre' => 'Une eleve',
                'form' => $formulaire->createView()
            ]);
        }
    }

    /**
     * @Route("/eleve/{id}/sup", name="supeleve")
    */
    public function supEleve($id, EleveRepository $repository, EntityManagerInterface $em){     
        $eleve = $repository->find($id);
        $em-> remove($eleve);
        $em->flush();

        return $this->redirectToRoute('eleve');
    }
}
