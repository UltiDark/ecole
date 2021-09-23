<?php

namespace App\Controller;

use App\Entity\Prof;
use App\Form\Type\ProfType;
use App\Repository\ProfRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfController extends AbstractController
{
    /**
    * @Route("/prof", name="prof")
    */
    public function afficheListeProf(ProfRepository $repository){
        $profs = $repository->findAll();
        return $this->render('prof.html.twig',[
            "profs" => $profs
        ]);
    }

    /**
    * @Route("/prof/create", name="createprof")
    */
    public function createProf(Request $request, EntityManagerInterface $em){
        $prof = new Prof;
        $formulaire = $this->createForm(ProfType::class, $prof);
        $formulaire->handleRequest($request);


        if ($formulaire->isSubmitted() && $formulaire->isValid()) {

            $em->persist($prof);
            $em->flush();

            return $this->redirectToRoute('accueil');
        }
        else
        {
            return $this->render('formulaire.html.twig', [
                'titre' => 'Un Professeur',
                'form' => $formulaire->createView()
            ]);
        }
    }

    /**
     * @Route("/prof/{id}/sup", name="sup")
    */
    public function supCandy($id, ProfRepository $repository, EntityManagerInterface $em){     
        $prof = $repository->find($id);
        $em-> remove($prof);
        $em->flush();

        return $this->redirectToRoute('prof');
    }
}