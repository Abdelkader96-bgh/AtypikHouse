<?php

namespace App\Controller;
use App\Entity\Base\Cabane;
use App\Entity\Base\CabaneSearch;
use App\Entity\Base\Images;
use App\Entity\Base\User;
use DateTime;
use App\Entity\Base\PointVue;
use App\Form\CabaneSearchType;
use App\Form\CabaneType;
use App\Form\PointVueType;
use App\Repository\PointVueRepository;
use App\Repository\UserRepository;
use App\Repository\PartnerRepository;
use App\Repository\CabaneRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

  /**
   * @Route("/cabane")
   */
  class CabaneController extends AbstractController
        {
         // le formulaire pour ajouter un cabane
                    
                    /**
                     * @IsGranted("ROLE_HOTE")
                     * @Route("/new", name="cabane_new",methods={"GET","POST"})
                     * @param Request $request
                     * @param UserRepository $userRepository
                     * @return Response
                     * @param ObjectManager $manager
                     * @throws \Exception
                     */
                    public function new(Request $request,UserRepository $userRepository):Response
                    {
                         $user = $this->getUser();  
                         //echo "[" . $user->getId() . "]";
                         $cabane = new Cabane();
                         $form = $this->createForm(CabaneType::class, $cabane);
                         $form->handleRequest($request);
                        if ($form->isSubmitted() && $form->isValid()) {
                            $cabane->setCreatedAt(new DateTime())
                                   ->setUser($user);
                                   //->setHote($user);
                            //on récupère les images transmises
                            $images=$form->get('images')->getData();
                            // on boucle sur les images
                            foreach($images as $image){
                                //on gènère un nouveau nom de fichier
                                $file= md5(uniqid()) . '.' . $image->guessExtension();
                                // on copie le fichier dans le dossier uploads
                                $image->move(
                                    $this->getParameter('images_directory'),
                                    $file
                                );
                                // on stocke l'image dans la base de données ( son non mais l'image et dans le dossier uploads)
                                // une nouvelle instance d enotre image
                                $img = new Images();
                                $img->setName($file);
                                $cabane->addImage($img);                          
                            }
                            $em =$this->getDoctrine()->getManager();
                            $em->persist($cabane);
                            $em->flush();
                            return $this->redirectToRoute('cabane_show');
                        }
                            //return new Response('cabane ajouté ! ');
                         //}
                                   
                        return $this->render('cabane/new.html.twig', [
                            'cabane' => $cabane,
                            'form' => $form->createView(),
                            //'user' => $user                           
                        ]);
                         }

                      //showcabane la liste des cabanes rajoutés par tout les admins et les partenaires
                    /**
                     * @Route("/show", name="cabane_show", methods={"GET"})
                     * @param CabaneRepository $cabaneRepository
                     * @return Response
                     * @param Request $request
                     */
                     public function show(CabaneRepository $cabaneRepository,Request $request, PaginatorInterface $paginator ):Response
                    {
                    $search =new CabaneSearch();
                    $form=$this->createForm(CabaneSearchType::class,$search);
                    $form->handleRequest($request);
                    
                    //$cabanes=$this->repository->findAllVisible();
                        $donnees=$this->getDoctrine()->getRepository(Cabane::class)->findby([],['id' => 'DESC']);  
                        $cabanes=$paginator->paginate(
                            $donnees,
                            $request->query->getInt('page',1),4
                        );
                     return $this->render('cabane/show.html.twig', [
                        
                         'cabanes'=>$cabanes ,
                         'form'=> $form->createView()
                        ]);
                     }

                    // regarder le détail de chaque cabane

                    /**
                     * @Route("/{cabane}", name="cabane_detail",methods={"GET","POST"})
                     * @param Request $request
                     * @param Cabane $cabane
                     * @return Response
                     * @param ObjectManager $manager
                     */
                    public function detail(Request $request , Cabane $cabane,CabaneRepository $cabaneRepository):Response
                    {
                        //rajouter un point de vue sur le cabane 
                        $pointVue = new PointVue();
                        $form = $this->createForm(PointVueType::class, $pointVue);
                        $form->handleRequest($request);
                        if ($form->isSubmitted() && $form->isValid()) {
                            $pointVue->setCreatedAt(new \DateTime());
                            $pointVue->setCabane($cabane);
                            $em =$this->getDoctrine()->getManager();
                            $em->persist($pointVue);
                            $em->flush();
                        }
                        return $this->render('cabane/detail.html.twig', [
                            'cabane' => $cabane,
                            'pointVue'=>$pointVue,
                            'form' => $form->createView(),
                        ]);
                    }
                
                    // modifier un cabane est le role du partenaire ou de l'admin  
                    /**
                     * @IsGranted("ROLE_HOTE")
                     * @Route("/{cabane}/edit", name="cabane_edit", methods={"GET","POST"})
                     * @param Request           $request
                     * @param ObjectManager     $manager
                     * @param Cabane            $cabane
                     * @param ProjectRepository $projectRepository
                     * @return Response
                     */
                    public function edit(Request $request, Cabane $cabane): Response
                    {
                        $form = $this->createForm(CabaneType::class, $cabane);
                        $form->handleRequest($request);
                        if($form->isSubmitted() && $form->isValid()) {
                            //on récupère les images transmises
                            $images=$form->get('images')->getData();
                            // on boucle sur les images
                            foreach($images as $image){
                                //on gènère un nouveau nom de fichier
                                $fichier= md5(uniqid()) . '.' . $image->guessExtension();
                                // on copie le fichier dans le dossier uploads
                                $image->move(
                                    $this->getParameter('images_directory'),
                                    $fichier
                                );
                                // on stocke l'image dans la base de données ( son non mais l'image et dans le dossier uploads)
                                // une nouvelle instance de notre image
                                $img = new Images();
                                $img->setName($fichier);
                                $cabane->addImage($img);
                                }

                            $this->getDoctrine()->getManager()->flush();
                            //après la modification la page des cabanes qui s'affiche directement 
                            return $this->redirectToRoute('cabane_show');
                            }
                        return $this->render('cabane/edit.html.twig', [
                            'cabane' => $cabane,
                            'form' => $form->createView(),
                        ]);
                    }

                    //supprimer une cabane  le role du partenaire est de l'admin 
                    /**
                     * @IsGranted("ROLE_HOTE")
                     * @Route("/{cabane}", name="cabane_delete", methods={"DELETE"})
                     * @param Cabane $cabane
                     * @return Response
                     */
                    public function delete(Request $request , Cabane $cabane): Response
                    {
                        //if($this->isCsrfTokenValid('delete' .$cabane->getId(), $request->request->get('_token'))){
                            $entityManager =$this->getDoctrine()->getManager();
                            $entityManager->remove($cabane);
                            $entityManager->flush();
                      //}
                        return $this->redirectToRoute('cabane_show');
                    }

                    //au niveau de la modification en peut supprimer les images avant de suprimer le cabane
                    /**
                     * @IsGranted("ROLE_HOTE")
                     * @Route("/supprimer/image/{id}", name="cabane_delete_image", methods={"DELETE"})
                     */
                    public function deleteImage(Images $image, Request $request)
                    {
                        $data=json_decode($request->getContent(),true);

                        // on essaye de vérifier si le token est valide
                        if ($this->isCsrfTokenValid('delete' .$image->getId(), $data['_token'])){
                            //on récupère le nom de l'image
                            $nom=$image->getName();
                            //on supprime l'image dans le dossier uploads
                            unlink($this->getParameter('images_directory').'/'.$nom);

                            //on supprime aussi l'image de la base de donnée
                            $em=$this->getDoctrine()->getManager();
                            $em->remove($image);
                            $em->flush();
                            //on répond en json
                            return new JsonResponse(['success' => 1]);
                        }
                        else{
                            return new JsonResponse(['error' =>'Token Invalide'], 400);
                        }            
                    }

              //supprimer un commentaires
            /**
             * @IsGranted("ROLE_HOTE")
             * @Route("/{cabane}/delete", name="cabane_delete_pointVue", methods={"GET", "POST"})
             * @param Request $request
             * @param ObjectManager $manager
             * @param Cabane $cabane
             * @return Response
             */
            public function deletePointVue(Request $request, Cabane $cabane): Response
            {
                $pointVueId = $request->query->get('pointVue');
                $pointVue = $this->getDoctrine()->getRepository(PointVue::class)->find($pointVueId);
                
                $em=$this->getDoctrine()->getManager();
                $cabane->removePointVue($pointVue);
                //$this->manager->persist($pointVue);
                $em->persist($pointVue);
                $em->persist($cabane);
                $em->flush();
                return $this->redirectToRoute('cabanead_detail', [
                    'cabane' => $cabane->getId(),
                ]);
            }
        }
    
   