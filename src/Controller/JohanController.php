<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class JohanController extends AbstractController
{
    #[Route('/johan', name: 'app_johan')]
    public function index(): JsonResponse
    {
        return new JsonResponse([
            "message"=> "Hola soy johan"
        ]);
    }
}
