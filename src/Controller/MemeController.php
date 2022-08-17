<?php

namespace App\Controller;

use App\Document\Meme;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MemeController extends AbstractController
{
    #[Route('/memes', name: 'app_meme', methods: ["GET"])]
    public function index(DocumentManager $docManager): JsonResponse
    {
        try{
            $cursor = $docManager
                ->getDocumentCollection(Meme::class)
                ->find();
            return $this->json([
                'memes' => $cursor->toArray()
            ]);
        }catch(\Exception $error){
            return $this->json([
                "message"=>$error->getCode()
            ]);
        }
    }

    #[Route("/meme", name: "create-meme", methods: ["POST"])]
    public function createMeme(DocumentManager $docManager, Request $request): JsonResponse
    {
        try{
            $meme = new Meme($request->request->get("path"));
            $docManager->persist($meme);
            $docManager->flush();
            return $this->json($meme->getId());
        }catch(\Exception $error){
            return $this->json([
                "message"=>$error->getCode()
            ]);
        }
    }
}
