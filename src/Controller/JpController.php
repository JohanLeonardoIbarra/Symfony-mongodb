<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JpController extends AbstractController
{
    #[Route('/jp', name: 'app_jp')]
    public function index(): Response
    {
        return $this->render('jp/index.html.twig', [
            'controller_name' => 'JpController',
        ]);
    }
}
