<?php

namespace SocialMedia\FriendsConsultation\Domain\User;

class FriendsConsultationService

{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserFriends(string $userId): void
    {
        $this->userRepository->getUserFriends($userId);
    }


}