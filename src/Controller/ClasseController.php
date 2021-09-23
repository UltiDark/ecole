<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\Type\ClasseType;
use App\Repository\ClasseRepository;
use App\Repository\EleveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClasseController extends AbstractController
{
    /**
    * @Route("/classe", name="classe")
    */
    public function afficheListeclasse(ClasseRepository $repository){
        $classes = $repository->findAll();
        return $this->render('classe.html.twig',[
            "classes" => $classes
        ]);
    }

    /**
    * @Route("/classe/create", name="createclasse")
    */
    public function createClasse(Request $request, EntityManagerInterface $em){
        $classe = new Classe;
        $formulaire = $this->createForm(ClasseType::class, $classe);
        $formulaire->handleRequest($request);


        if ($formulaire->isSubmitted() && $formulaire->isValid()) {

            $em->persist($classe);
            $em->flush();

            return $this->redirectToRoute('accueil');
        }
        else
        {
            return $this->render('formulaire.html.twig', [
                'titre' => 'Une classe',
                'form' => $formulaire->createView()
            ]);
        }
    }

    /**
     * @Route("/classe/{id}/sup", name="supclasse")
    */
    public function supClasse($id, EleveRepository $repositoryEleve, ClasseRepository $repository, EntityManagerInterface $em){     
        $classe = $repository->find($id);
        $eleves = $repositoryEleve->findby(['id_classe' => $id]);
        /*foreach($eleves as $eleve){
            if (!empty($eleve)) {
                return $this->redirectToRoute('eleve');
            }
        }*/
        $em-> remove($classe);
        $em->flush();

        return $this->redirectToRoute('classe');
    }
}
