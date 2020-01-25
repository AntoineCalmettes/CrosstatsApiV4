<?php

namespace App\Controller;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\User;
use App\Entity\UserRoleId;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
     * @Route("/api/user/{id}", name="user_show",methods={"GET"})
     */
    public function show(User $user,SerializerInterface $serializer)
    {
  
       $json = $serializer->serialize($user,'json',['groups' => 'detail']);
       return new JsonResponse($json,Response::HTTP_OK,[],true);
    }
  /**
     * @Route("/api/user", name="user_delete",methods={"DELETE"})
     */
    public function delete(User $user,ObjectManager $manager)
    {
  
       $manager->remove($user);
       return new JsonResponse("suppression de l'utilisateur réussis",Response::HTTP_OK,[],true);
    }


    /**
     * @Route("/api/create/user", name="user_create_anonymous",methods={"POST"})
     */
    public function create(Request $request,UserRepository $userRepo,SerializerInterface $serializer,RoleRepository $roleRepo,UserPasswordEncoderInterface $encoder,EntityManagerInterface $em,ValidatorInterface $validator)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $request->getContent();
        // $roles = $request->request->get('roles');
        // $password = $request->request->get('password')   ;
        $user = $serializer->deserialize($data,User::class,'json');
        $error = $validator->validate($user);
        if(count($error) > 0){
           return $this->json($error,400);
        }
        $em->persist($user);
        $em->flush();

       $json = $serializer->serialize($user,'json',['groups'=>'detail']);
      
    //    $json = $serializer->serialize($user,'json',['groups' => 'detail']);
       return new JsonResponse("ok",Response::HTTP_OK,[],false);
    }

    /**
     * @Route("/api/user", name="user_update",methods={"PUT"})
     */
    public function update(Request $request,UserRepository $userRepo,SerializerInterface $serializer,RoleRepository $roleRepo,UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();
        $idUser = $request->request->get('id');
        $email = $request->request->get('email');
        $roles = $request->request->get('roles');

        if(empty($idUser)){
            return new JsonResponse("id introuvable",Response::HTTP_NO_CONTENT,[],true);
        }
        if(empty($email)){
            return new JsonResponse("id introuvable",Response::HTTP_NO_CONTENT,[],true);
        }
      
        if(empty($roles)){
            return new JsonResponse("roles introuvable",Response::HTTP_NO_CONTENT,[],true);
        }

       $user = $userRepo->find($idUser);
       if(empty($user)){
        return new JsonResponse("user introuvable",Response::HTTP_NO_CONTENT,[],true);
       }
       foreach($roles as $role){
           $roleObject = $roleRepo->find($role);
           $UserRoleId = new UserRoleId();
           $UserRoleId->setIdUser($user);
           $UserRoleId->setIdRole($role);
       }
       $user->setEmail($email);
       $em->persist($user);
       $em->flush();
       $em->persist($role);
       $em->flush();
       
      
       $json = $serializer->serialize($user,'json',['groups' => 'detail']);
       return new JsonResponse($json,Response::HTTP_OK,[],true);
    }
}
