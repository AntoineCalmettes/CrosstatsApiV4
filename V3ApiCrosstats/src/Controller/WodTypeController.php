<?php

namespace App\Controller;

use App\Entity\WodType;
use App\Repository\WodTypeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WodTypeController extends AbstractController
{
      /**
     * @Route("/api/wod/type", name="list_wod_type",methods={"GET"})
     */
    public function list(WodTypeRepository $wodTypeRepository,SerializerInterface $serializer)
    {
  
       $typeWod = $wodTypeRepository->findAll();
       $json = $serializer->serialize($typeWod,'json',['groups' => 'detail']);
       return new JsonResponse($json,Response::HTTP_OK,[],true);
    }

    /**
     * @Route("/api/wod/type/{id}", name="role_show_id",methods={"GET"})
     */
    public function show(WodType $wodType,SerializerInterface $serializer)
    {
       $json = $serializer->serialize($wodType,'json',['groups' => 'detail']);
       return new JsonResponse($json,Response::HTTP_OK,[],true);
    }
}
