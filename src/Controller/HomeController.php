<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
