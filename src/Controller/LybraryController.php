<?php

namespace App\Controller;

use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LybraryController extends AbstractController
{
	public function __construct() {

	}
	#[Route('/lybrary', name: 'app_lybrary')]
	public function list (Request $request): JsonResponse
	{
		$title = $request->get('title');
		$response = new JsonResponse();
		$response->setData([
			'succes' => true,
			'data' => [
				['id' => 1,
					'title' => 'libro 1'],
				[
					'id' => 2,
					'title' => '$title'
				]
			]
		]);
		return $response;
	}
}
