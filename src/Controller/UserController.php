<?php

namespace App\Controller;

use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'list_user', methods: ["GET"])]
    public function index(DocumentManager $documentManager): JsonResponse
    {
        try{
            $cursor = $documentManager
                ->getDocumentCollection(User::class)
                ->find();
            return new JsonResponse([
                "Users"=>$cursor->toArray()
            ]);
        }catch(\Exception $error){
            return new JsonResponse([
                "message" => $error->getMessage(),
            ]);
        }
    }

    #[Route('/user', name: 'create_user', methods: ["POST"])]
    public function create(DocumentManager $documentManager, Request $request): JsonResponse
    {
        try{
            $data = $request->toArray();
            $user = new User($data["name"], $data["surname"], $data["phone"]);
            $documentManager->persist($user);
            $documentManager->flush();
            return new JsonResponse([
                "User"=>$user->toString(),
            ]);
        }catch(\Exception $error){
            return new JsonResponse([
                "message" => $error->getMessage(),
            ]);
        }
    }
}
