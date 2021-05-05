<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**  
 * 
 * @Route("/")
 */
        
 class HomeController extends AbstractController
 {
   //la page d'acceuil 
/**
 * @Route("/", name="home_page")
*/
public function home(): Response
 {
 return $this->render('home/home.html.twig', [
  'controller_name' => 'HomeController',
  ]);

    }
 }