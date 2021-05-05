<?php

namespace App\Controller;

use App\Entity\Base\Partner;
use App\Form\PartnerType;
use App\Entity\Base\Images;
use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use DateTime;

/**
 * @Route("/partner")
 */
class PartnerController extends AbstractController
{
    /**
     * @Route("/devenirPartenaire", name="devenir_partner")
     */
    public function index1(): Response
    {
        return $this->render('partner/devenirPartner.html.twig', [
            'controller_name' => 'PartnerController',
        ]);
    }

    /**
     * @Route("/", name="partner_index", methods={"GET"})
     */
    public function index(PartnerRepository $partnerRepository): Response
    {
        return $this->render('partner/index.html.twig', [
            'partners' => $partnerRepository->findAll(),
        ]);
    }

    //formulaire pour le partenaire
      /**
       * @IsGranted("ROLE_USER")
       * @Route("/new", name="partner_new", methods={"GET","POST"})
       */
       public function new(Request $request): Response
    {
        
        $partner = new Partner();
        $form = $this->createForm(PartnerType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
      
             //on récupère les images transmises
            $images=$form->get('images')->getData();
                // on boucle sur les images
            foreach($images as $image){
                 //on gènère un nouveau nom de fichier
            $file= md5(uniqid()) . '.' . $image->guessExtension();
                 // on copie le fichier dans le dossier uploads
              $image->move(
                  $this->getParameter('images_directory3'),
             $file 
            );
             // on stocke l'image dans la base de données ( son non mais l'image et dans le dossier uploads)
             // une nouvelle instance d enotre image
             $img = new Images();
             $img->setName($file);
             $partner->addImage($img);          
            }
            $partner->setCreatedAt(new DateTime());  
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($partner);
            $entityManager->flush();
         

            return new Response('Votre formulaire est ajouté avec succsés .Un membre de notre équipe étudiera votre demande et reviendra vers vous dès que possible ! ');
         }
       

        return $this->render('partner/new.html.twig', [
            'partner' => $partner,
            'form' => $form->createView(),
        ]);
    }




    /**
     * @Route("/{id}", name="partner_show", methods={"GET"})
     */
    public function show(Partner $partner): Response
    {
        return $this->render('partner/show.html.twig', [
            'partner' => $partner,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="partner_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Partner $partner): Response
    {
        $form = $this->createForm(PartnerType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('partner_index');
        }

        return $this->render('partner/edit.html.twig', [
            'partner' => $partner,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="partner_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Partner $partner): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partner->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($partner);
            $entityManager->flush();
        }
        return $this->redirectToRoute('partnerad_show');
    }
}
