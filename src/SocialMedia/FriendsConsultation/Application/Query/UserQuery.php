<?php

namespace SocialMedia\FriendsConsultation\Application\Query;

use SocialMedia\FriendsConsultation\Domain\User\User;
use SocialMedia\FriendsConsultation\Domain\User\UserRepository;
use SocialMedia\UserRegister\Domain\User\UserId;

class UserQuery
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function fetchAll($uid): array
    {
        $results = $this->repository->getUserFriends(UserId::fromString($uid)->toString());

        return \array_map(function (User $item) {
            return new UserDTO(
                $item->getUserName()->getName()
            );
        }, $results);
    }
}
