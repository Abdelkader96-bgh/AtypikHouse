<?php

namespace App\Controller\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/admin/users")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/showuser", name="user_show", methods={"GET"})
     * @param UserRepository $userRepository
     * @return Response
     * @param Request $request
     */
    public function showUser(UserRepository $UserRepository):Response
    {
       return $this->render('admin/users/showuser.html.twig', [
           'users'=>$UserRepository->findAll(),   
        ]);
    }

}