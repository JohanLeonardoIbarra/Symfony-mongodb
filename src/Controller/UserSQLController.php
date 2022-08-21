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

#[Route('/user/sql')]
class UserSQLController extends AbstractController
{
    #[Route('/', name: 'app_user_s_q_l_index', methods: ['GET'])]
    public function index(UserSQLRepository $userSQLRepository): JsonResponse
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
    public function show(Request $request, UserSQLRepository $repository): JsonResponse
    {
        try{
            $id = $request->attributes->all()["id"];
            $user = $repository->findOneBy(["id"=>$id]);
            return $this->json($user);
        }catch(\Exception $error){
            return $this->json([
                "message"=>$error->getMessage()
            ]);
        }
    }

    #[Route('/{id}/edit', name: 'app_user_s_q_l_edit', methods: ['GET', 'PUT'])]
    public function edit(Request $request, UserSQLRepository $userSQLRepository): Response
    {
        //Capturo el id junto con el body
        $id = $request->attributes->all()["id"];
        $requestData = $request->toArray();
        //Busco el usuario en la base de datos
        $userSQL = $userSQLRepository->findOneBy(["id"=>$id]);
        $userSQL->setName($requestData["name"])
             ->setSurname($requestData["surname"])
             ->setPhone($requestData["phone"]);
        //Actualizo el valor en la base de datos
        $userSQLRepository->add($userSQL, true);
        //return json
        return $this->json($userSQL);
    }

    #[Route('/{id}', name: 'app_user_s_q_l_delete', methods: ['DELETE'])]
    public function delete(Request $request, UserSQL $userSQL, UserSQLRepository $userSQLRepository): Response
    {
        //Capturo el id
        $id = $request->attributes->all()["id"];

        $user = $userSQLRepository->findOneBy(["id"=>$id]);
        $userSQLRepository->remove($user, true);

        return $this->json([
            "success"=>"User $id Deleted"
        ]);
    }
}
