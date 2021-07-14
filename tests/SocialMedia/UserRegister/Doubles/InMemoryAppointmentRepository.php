<?php

namespace Tests\SocialMedia\UserRegister\Doubles;

use SocialMedia\UserRegister\Domain\User\User;
use SocialMedia\UserRegister\Domain\User\UserName;
use SocialMedia\UserRegister\Domain\User\UserRepository;

class InMemoryUserRepository implements UserRepository
{
    private array $users = [];

    public function getUserByName(UserName $userName): ?User
    {
        $results = array_filter($this->users, function (User $item) use ($userName) {
            return $item === $userName;
        });

        return $results[0] ?? null;
    }

    public function store(User $User): void
    {
        $this->users[] = $User;
    }

    public function getAll(): array
    {
        return $this->users;
    }
}
