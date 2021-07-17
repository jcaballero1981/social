<?php

namespace App\Controller;

use SocialMedia\UserRegister\Application\Command\Register\UserRegisterCommand;
use SocialMedia\UserRegister\Application\Command\Register\UserRegisterCommandHandler;
use SocialMedia\UserRegister\Domain\User\UserRegisterService;
use SocialMedia\UserRegister\Infrastructure\DbalUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route as Route;

class ApiUserRegisterController extends AbstractController
{


    /**
     * @Route("/users", name="users_register, methods={"POST"});
     */
    public function register(Request $request, DbalUserRepository $userRepository ): JsonResponse
    {
        $data= json_decode($request->getContent(), true);

        $command = new UserRegisterCommand(
            $data["username"],
            $data["password"]
        );

        $handler = new UserRegisterCommandHandler(new UserRegisterService($userRepository));
        $handler($command);

        return new JsonResponse(
            [
                'status' => 'ok',
            ], JsonResponse::HTTP_CREATED
        );

    }
}
