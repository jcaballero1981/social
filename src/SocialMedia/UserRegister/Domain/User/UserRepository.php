<?php

namespace SocialMedia\UserRegister\Domain\User;

interface UserRepository
{
    public function getUserByName(UserName $userName): ?User;

    public function store(User $user): void;

    /**
     * @return User[]
     */
    public function getAll(): array;
}
