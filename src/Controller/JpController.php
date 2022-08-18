<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class JpController extends AbstractController
{
    #[Route('/jp', name: 'app_jp')]
    public function index(): JsonResponse
    {
        return $this->json(['message' => 'hola','name' => 'Juan Pablo']);
    }
}
