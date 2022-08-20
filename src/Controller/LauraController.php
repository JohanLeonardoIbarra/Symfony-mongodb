<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class LauraController extends AbstractController {
    #[Route('/laura/saludar', name:'laura_saludar')]
    public function saludar(): JsonResponse {
        return new JsonResponse(['saludo'=>'hola']);
    }
}


