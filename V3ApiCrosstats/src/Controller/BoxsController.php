<?php

namespace App\Controller;

use App\Entity\Box;
use App\Repository\BoxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BoxsController extends AbstractController
{
    /**
     * @Route("/api/boxs", name="boxs_list",methods={"GET"})
     */
    public function list(BoxRepository $boxRepo,SerializerInterface $serializer)
    {
  
       $boxs = $boxRepo->findAll();
       $json = $serializer->serialize($boxs,'json',['groups' => 'detail']);
       return new JsonResponse($json,Response::HTTP_OK,[],true);
    }

     /**
     * @Route("/api/boxs/{id}", name="box_show_id",methods={"GET"})
     */
    public function show(Box $box,SerializerInterface $serializer)
    {
       $json = $serializer->serialize($box,'json',['groups' => 'detail']);
       return new JsonResponse($json,Response::HTTP_OK,[],true);
    }

     /**
     * @Route("/api/boxs", name="box_delete",methods={"DELETE"})
     */
    public function delete(Box $box,ObjectManager $manager)
    {
  
       $manager->remove($box);
       return new JsonResponse("suppression de la réussis",Response::HTTP_OK,[],true);
    }


    /**
     * @Route("/api/boxs", name="boxs_update",methods={"PUT"})
     */
    public function update(Request $request,Box $box,SerializerInterface $serializer,ObjectManager $manager)
    {
       $data = $request->getContent();
       $serializer->deserialize($data,Box::class,'json',['object_to_populate'=>$box]);
       $manager->persist($box);
       $manager->flush();
       $json = $serializer->serialize($box,'json',['groups' => 'detail']);
       return new JsonResponse($json,Response::HTTP_OK,[],true);
    }

    /**
     * @Route("/api/boxs", name="box_create",methods={"POST"})
     */
    public function create(Request $request,SerializerInterface $serializer,EntityManagerInterface $em,ValidatorInterface $validator)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $request->getContent();
        
        // $roles = $request->request->get('roles');
        // $password = $request->request->get('password')   ;
        $box = $serializer->deserialize($data,Box::class,'json');
        $error = $validator->validate($box);
        if(count(array($error)) > 1){
           return $this->json($error,400);
        }
        $em->persist($box);
        $em->flush();
       $json = $serializer->serialize($box,'json',['groups'=>'detail']);
      
    //    $json = $serializer->serialize($user,'json',['groups' => 'detail']);
       return new JsonResponse("Box crée avec succès",Response::HTTP_CREATED,[],true);
    }
}
