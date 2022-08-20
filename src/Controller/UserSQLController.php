<?php

namespace App\Controller;

use App\Entity\UserSQL;
use App\Form\UserSQLType;
use App\Repository\UserSQLRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;

#[Route('/user_sql')]
class UserSQLController extends AbstractController
{
    #[Route('/', name: 'app_user_s_q_l_index', methods: ['GET'])]
    public function index(UserSQLRepository $userSQLRepository): Response
    {
        $data = $userSQLRepository->findAll();
        return $this->json($data);
    }

    #[Route('/new', name: 'app_user_s_q_l_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserSQLRepository $userSQLRepository): Response
    {
        try{
            $requestData = $request->toArray();
            if (in_array(null, $requestData)) {
                return new JsonResponse(["message" => "invalid fields"]);
            }
            $userSQL = new UserSQL();
            $userSQL->setName($requestData["name"])
                ->setSurname($requestData["surname"])
                ->setPhone($requestData["phone"]);
            $userSQLRepository->add($userSQL, true);
            return new JsonResponse([
                "user"=>$userSQL->toString()
            ]);
        }catch (\Exception $error){
            return new JsonResponse(["message"=>$error->getMessage()]);
        }
    }

    #[Route('/{id}', name: 'app_user_s_q_l_show', methods: ['GET'])]
    public function show(UserSQL $userSQL): Response
    {
        return $this->render('user_sql/show.html.twig', [
            'user_s_q_l' => $userSQL,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_s_q_l_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserSQL $userSQL, UserSQLRepository $userSQLRepository): Response
    {
        $form = $this->createForm(UserSQLType::class, $userSQL);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userSQLRepository->add($userSQL, true);

            return $this->redirectToRoute('app_user_s_q_l_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_sql/edit.html.twig', [
            'user_s_q_l' => $userSQL,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_s_q_l_delete', methods: ['POST'])]
    public function delete(Request $request, UserSQL $userSQL, UserSQLRepository $userSQLRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userSQL->getId(), $request->request->get('_token'))) {
            $userSQLRepository->remove($userSQL, true);
        }

        return $this->redirectToRoute('app_user_s_q_l_index', [], Response::HTTP_SEE_OTHER);
    }
}
