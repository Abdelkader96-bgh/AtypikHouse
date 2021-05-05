<?php

namespace App\Controller;

use App\Entity\Base\User;
use App\Form\RegistrationType;
use App\Form\UserEditRoleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\UserRepository;
use App\Repository\CabaneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
         //inscription nouveau utilisateur 
            /**
             * @Route("/inscription", name="security_inscr")
             */
            public function registration(Request $request,UserPasswordEncoderInterface $encoder): Response
            {
                $user = new User();          
                $form = $this->createForm(RegistrationType::class, $user);
                $form->handleRequest($request);
        
                if ($form->isSubmitted() && $form->isValid()) {
                    $hash=$encoder->encodePassword($user , $user->getPassword());
                    $user->setPassword($hash);
                    //on active par défaut
                    $user->setIsActive(true);
                    $em =$this->getDoctrine()->getManager();
                    $em->persist($user);
                    $em->flush();
        
                    return $this->redirectToRoute('security_login');
                     }
        
                return $this->render('security/registration.html.twig', [
                    'user' => $user,
                    'form' => $form->createView(),
                    'mainNavRegistration' => true, 
                    'title' => 'Inscription'      
                ]);
                     }
                 //pour ce connecter

              /**
               * @Route("/connexion", name="security_login")
               */

            public function login(){
                  return $this->render ('security/login.html.twig');
            }
                   //pour ce déconnecter
             /**
              * @Route("/deconnexion", name="security_logout")
              */
                 public function logout(){
               }
                 

             /**
              *@Route("/modifier",name="role_edit")
              */
            public function editUser(Request $request, User $user, UserRepository $userRepository, EntityManagerInterface $em)
            {
             $form= $this->createForm(UserEditRoleType::class,$user);
             $form->handleRequest($request);
             if($form->isSubmitted()&&$form->isValid())
            {
             // modifier le role juste au niveau de la base de donne
             $em ->flush();
            return $this->redirectToRoute('cabane_new');
            }
            return $this->render( 'security/editRoleUser.html.twig',[
               'formUser' => $form->createView()]);
            }

            //regarder les cabanes ajoutés par les 

            /**
             * @IsGranted("ROLE_HOTE")
             * @Route("/usercabane", name="user_cabane", methods={"GET"})
             * @param CabaneRepository $cabaneRepository
             * @return Response
             * @param Request $request
             */
            public function showCabane(CabaneRepository $cabaneRepository):Response
          {
              $user = $this->getUser(); 
            return $this->render('security/showmescabanes.html.twig', [
              'cabanes'=>$cabaneRepository->findAll(),
              'user' =>$user,      
           ]);
          }

    /**
     * @Route("/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
      $user = new User();          
      $form = $this->createForm(RegistrationType::class, $user);
      $form->handleRequest($request);
           $user = $this->getUser();
      if ($form->isSubmitted() && $form->isValid()) {
          
          $this->getDoctrine()->getManager()->flush();

           return new Response('modification bien faite ! ');
           }

      return $this->render('security/edituser.html.twig', [
          'user' => $user,
          'form' => $form->createView(),
      ]);  

   
      }


  }  