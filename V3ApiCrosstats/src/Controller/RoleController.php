<?php

namespace App\Controller;

use App\Repository\RoleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RoleController extends AbstractController
{
      /**
     * @Route("/api/roles", name="list",methods={"GET"})
     */
    public function list(RoleRepository $roleRepository,SerializerInterface $serializer)
    {
  
       $users = $roleRepository->findAll();
       $json = $serializer->serialize($users,'json',['groups' => 'detail']);
       return new JsonResponse($json,Response::HTTP_OK,[],true);
    }
}
