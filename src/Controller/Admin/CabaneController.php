<?php

namespace App\Controller\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CabaneRepository;
use App\Repository\UserRepository;
use App\Entity\Base\Cabane;
use App\Repository\PointVueRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin/cabane")
 */
class CabaneController extends AbstractController
{
    /**
     * @Route("/showcabane", name="cabanead_show", methods={"GET"})
     * @param CabaneRepository $cabaneRepository
     * @param UserRepository $userRepository
     * @return Response
     * @param Request $request
     */
    public function showCabane(CabaneRepository $cabaneRepository,UserRepository $userRepository):Response
    {
       return $this->render('admin/cabane/showcabane.html.twig', [
           'cabanes'=>$cabaneRepository->findAll(),
            'user'=>$user = $this->getUser(),
                   
        ]);
    }

/**
     * @Route("/{cabane}", name="cabanead_detail", methods={"GET"})
     */
    public function show(Cabane $cabane): Response
    {
        return $this->render('admin/cabane/detailcabane.html.twig', [
            'cabane' => $cabane,
        ]);
    }
        
        


}