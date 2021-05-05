<?php

namespace App\Controller\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PartnerRepository;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/admin/partner")
 */
class PartnerController extends AbstractController
{
    /**
     * @Route("/showpartner", name="partnerad_show", methods={"GET"})
     * @param PartnerRepository $partnerRepository
     * @return Response
     * @param Request $request
     */
    public function showPartner(PartnerRepository $partnerRepository):Response
    {
       return $this->render('admin/partner/showpartner.html.twig', [
           'partners'=>$partnerRepository->findAll(),   
        ]);
    }

}