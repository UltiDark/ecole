<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Form\Type\EleveType;
use App\Repository\EleveRepository;
use App\Repository\NoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EleveController extends AbstractController
{
    /**
    * @Route("/eleve", name="eleve")
    */
    public function afficheListeeleve(EleveRepository $repository, NoteRepository $repositoryNote, EntityManagerInterface $em){
        $eleves = $repository->findAll();
        $notes = $repositoryNote->findAll();
        foreach ($notes as $note){
            if ($note->getIdEleve() == null){
                $em->remove($note);
                $em->flush();
            }
        }
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
                'titre' => 'Ajouter une eleve',
                'form' => $formulaire->createView()
            ]);
        }
    }

    /**
    * @Route("/eleve/{id}/detail", name="detaileleve")
    */
    public function detailEleve($id, EleveRepository $repository, NoteRepository $repositoryNote){
        $eleve = $repository->find($id);
        $notes = $repositoryNote->findBy(['id_eleve' => $id]);

        $total = 0;
        $nbNote = 0;

        if(!empty($notes)){
            foreach ($notes as $note){
                $total += $note->getNote() * $note->getCoefficient();
                $nbNote += $note->getCoefficient();
            }
            $moyenne = $total / $nbNote;
        }
        else{
            $moyenne = "Pas de note";
        }


        return $this->render('detail-eleve.html.twig',[
            'eleve' => $eleve,
            'moyenne' => $moyenne,
            'notes' => $notes
        ]);
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
