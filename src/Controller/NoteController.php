<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\Type\NoteType;
use App\Repository\EleveRepository;
use App\Repository\NoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class NoteController extends AbstractController
{
    /**
     * @Route("/note/{id}/createnote", name="createnote")
     */
    public function createNote($id, Request $request, EntityManagerInterface $em, EleveRepository $eleveRepository){
        $note = new Note;
        $eleve = $eleveRepository->findOneBy(['id'=>$id]);
        $formulaire = $this->createForm(NoteType::class, $note);
        $formulaire->handleRequest($request);


        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $note->setIdEleve($eleve);
            if($note->getNote() > 20 || $note->getNote() < 0){
                return $this->render('formulaire.html.twig', [
                    'titre' => 'Une Note Pour '. $eleve->getNom(). ' ' .$eleve->getPrenom(),
                    'form' => $formulaire->createView()
                ]);
            }
            $em->persist($note);
            $em->flush();

            return $this->redirectToRoute('detaileleve', ['id' => $id]);
        }
        else
        {
            return $this->render('formulaire.html.twig', [
                'titre' => 'Une Note Pour '. $eleve->nom. ' ' .$eleve->prenom,
                'form' => $formulaire->createView()
            ]);
        }
    }

    public static function supNote($id, NoteRepository $repository, EntityManagerInterface $em){     
        $note = $repository->find($id);
        $em-> remove($note);
        $em->flush();
    }
}