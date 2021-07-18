<?php

namespace SocialMedia\FriendsConsultation\Domain\User;

interface UserRepository
{

    /**
     * @return User[]
     */
    public function getUserFriends(string $userId): array;
}
