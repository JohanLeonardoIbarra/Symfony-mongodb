<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CamiloController extends AbstractController{

    #[Route('/camilo/list', name: 'camilo_list')]
    public function list() : JsonResponse{
        $response=new JsonResponse();
        $response->setData([
            'success'=> true,
            'data'=>[
                'saludo'=>'Hola, soy Camilo Hernandez'
            ]
        ]);

        return $response;
    }
}