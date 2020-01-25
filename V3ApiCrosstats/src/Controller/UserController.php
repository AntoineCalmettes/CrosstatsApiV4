<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserBoxId;
use App\Entity\UserRoleId;
use App\Repository\BoxRepository;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
     
      
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
     * @Route("/api/users/email/{email}", name="user_show",methods={"GET"})
     */
    public function show(User $user,SerializerInterface $serializer)
    {
  
       $json = $serializer->serialize($user,'json',['groups' => 'detail']);
       return new JsonResponse($json,Response::HTTP_OK,[],true);
    }

      /**
     * @Route("/api/users/{id}", name="user_show_id",methods={"GET"})
     */
    public function showId(User $user,SerializerInterface $serializer,$id,UserRepository $repo)
    {
       $user = $repo->findOneBy(['id'=>$id]);
       $json = $serializer->serialize($user,'json',['groups' => 'detail']);
       return new JsonResponse($json,Response::HTTP_OK,[],true);
    }
  /**
     * @Route("/api/users", name="user_delete",methods={"DELETE"})
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
        if(count(array($error)) > 1){
           return $this->json($error,400);
        }
        $em->persist($user);
        $em->flush();
        $UserRoleId = new UserRoleId();
        $UserRoleId->setIdRole($roleRepo->findOneBy(['libelle'=>'ROLE USER']));
        $UserRoleId->setIdUser($user);
        $em->persist($UserRoleId);
        $em->flush();
       $json = $serializer->serialize($user,'json',['groups'=>'detail']);
      
    //    $json = $serializer->serialize($user,'json',['groups' => 'detail']);
       return new JsonResponse("Utilisateur crée avec succès",Response::HTTP_CREATED,[],true);
    }

    /**
     * @Route("/api/users", name="user_update",methods={"PUT"})
     */
    public function update(Request $request,User $user,SerializerInterface $serializer,ObjectManager $manager)
    {
       $data = $request->getContent();
       $serializer->deserialize($data,User::class,'json',['object_to_populate'=>$user]);
       $manager->persist($user);
       $manager->flush();
       $json = $serializer->serialize($user,'json',['groups' => 'detail']);
       return new JsonResponse($json,Response::HTTP_OK,[],true);
    }
}
