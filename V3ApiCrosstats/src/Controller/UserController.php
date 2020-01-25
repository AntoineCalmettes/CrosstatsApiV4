<?php

namespace App\Controller;

use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
        /**
     * @Route("/", name="home",methods={"GET"})
     */
    public function home(UserRepository $userRepo,SerializerInterface $serializer)
    {
  
       
       return new JsonResponse("Welcome to api Crosstats, documentation to /api",Response::HTTP_OK,[],false);
    }
    /**
     * @Route("/api/users", name="user",methods={"GET"})
     */
    public function list(UserRepository $userRepo,SerializerInterface $serializer)
    {
  
       $users = $userRepo->findAll();
       $json = $serializer->serialize($users,'json',['groups' => 'detail']);
       return new JsonResponse($json,Response::HTTP_OK,[],true);
    }

    /**
     * @Route("/api/user", name="user_update",methods={"PUT"})
     */
    public function update(Request $request,UserRepository $userRepo,SerializerInterface $serializer,RoleRepository $roleRepo)
    {
    //     $em = $this->getDoctrine()->getManager();
    //     $idUser = $request->request->get('id');
    //     $email = $request->request->get('email');
    //     $roles = $request->request->get('roles');

    //     if(empty($idUser)){
    //         return new JsonResponse("id introuvable",Response::HTTP_NO_CONTENT,[],true);
    //     }
    //     if(empty($email)){
    //         return new JsonResponse("id introuvable",Response::HTTP_NO_CONTENT,[],true);
    //     }
      
    //     if(empty($roles)){
    //         return new JsonResponse("roles introuvable",Response::HTTP_NO_CONTENT,[],true);
    //     }

    //    $user = $userRepo->find($idUser);
    //    if(empty($user)){
    //     return new JsonResponse("user introuvable",Response::HTTP_NO_CONTENT,[],true);
    //    }
    //    foreach($roles as $role){
    //        $roleObject = $roleRepo->find($role);
    //        $user->addRole($roleObject);
    //    }
    //    $user->setEmail($email);
    //    $em->persist($user);
    //    $em->flush();
       
      
    //    $json = $serializer->serialize($user,'json',['groups' => 'detail']);
    //    return new JsonResponse($json,Response::HTTP_OK,[],true);
    }
}
