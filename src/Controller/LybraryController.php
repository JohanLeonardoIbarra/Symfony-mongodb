<?php

namespace App\Controller;

use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class LybraryController extends AbstractController
{
    #[Route('/lybrary', name: 'app_lybrary')]
    public function list(): JsonResponse
    {
        $response= new Response( [ 'hola']);
        return  $response;
    }
}
