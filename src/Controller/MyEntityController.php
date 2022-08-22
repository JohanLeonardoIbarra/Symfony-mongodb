<?php

namespace App\Controller;

use App\Entity\MyEntity;
use App\Form\MyEntityType;
use App\Repository\MyEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/my/entity')]
class MyEntityController extends AbstractController
{
    #[Route('/', name: 'app_my_entity_index', methods: ['GET'])]
    public function index(MyEntityRepository $myEntityRepository): Response
    {
        return $this->render('my_entity/index.html.twig', [
            'my_entities' => $myEntityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_my_entity_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MyEntityRepository $myEntityRepository): Response
    {
        $myEntity = new MyEntity();
        $form = $this->createForm(MyEntityType::class, $myEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $myEntityRepository->add($myEntity, true);

            return $this->redirectToRoute('app_my_entity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('my_entity/new.html.twig', [
            'my_entity' => $myEntity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_my_entity_show', methods: ['GET'])]
    public function show(MyEntity $myEntity): Response
    {
        return $this->render('my_entity/show.html.twig', [
            'my_entity' => $myEntity,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_my_entity_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MyEntity $myEntity, MyEntityRepository $myEntityRepository): Response
    {
        $form = $this->createForm(MyEntityType::class, $myEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $myEntityRepository->add($myEntity, true);

            return $this->redirectToRoute('app_my_entity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('my_entity/edit.html.twig', [
            'my_entity' => $myEntity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_my_entity_delete', methods: ['POST'])]
    public function delete(Request $request, MyEntity $myEntity, MyEntityRepository $myEntityRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$myEntity->getId(), $request->request->get('_token'))) {
            $myEntityRepository->remove($myEntity, true);
        }

        return $this->redirectToRoute('app_my_entity_index', [], Response::HTTP_SEE_OTHER);
    }
}
