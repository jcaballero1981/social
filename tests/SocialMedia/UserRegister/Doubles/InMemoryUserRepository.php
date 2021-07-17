<?php

namespace Tests\SocialMedia\UserRegister\Doubles;

use SocialMedia\UserRegister\Domain\User\User;
use SocialMedia\UserRegister\Domain\User\UserRepository;

class InMemoryUserRepository implements UserRepository
{
    private array $users = [];

    public function getUserByName($userName): ?User
    {
        $results = array_filter($this->users, function (User $item) use ($userName) {
            return $item->getUserName()->getName() === $userName;
        });

        return $results[0] ?? null;
    }

    public function store(User $user): void
    {
        $this->users[] = $user;
    }

    public function getAll(): array
    {
        return $this->users;
    }
}
