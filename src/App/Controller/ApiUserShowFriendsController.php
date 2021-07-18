<?php

namespace App\Controller;


use SocialMedia\FriendsConsultation\Application\Query\UserQuery;
use SocialMedia\FriendsConsultation\Infrastructure\DbalUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route as Route;

class ApiUserShowFriendsController extends AbstractController
{


    /**
     * @Route("/friends", name="user_friends, methods={"GET"});
     */
    public function friendsConsultation(Request $request, DbalUserRepository $userRepository): JsonResponse
    {
        /** todo implement authorization for this endpoint */

        $data= json_decode($request->getContent(), true);

        $friendsList= new UserQuery($userRepository);

        $friends = $friendsList->fetchAll( $data["uid"]);

        return new JsonResponse(
            $friends
        );

    }
}
