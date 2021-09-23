<?php

namespace App\Controller;

// use fonctionne comme require et  
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


// nos classes doivent etre une extension de la classe mere de Symfony
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function afficheHome(){
        return $this->render('home.html.twig',[]);
    }

        /**
     * @Route("/regle", name="regle")
     */
    public function afficheRegle(){
        return $this->render('regle.html.twig',[]);
    }
}
