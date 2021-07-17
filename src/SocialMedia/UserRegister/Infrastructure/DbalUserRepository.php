<?php

namespace SocialMedia\UserRegister\Infrastructure;

use SocialMedia\UserRegister\Domain\User\Password;
use SocialMedia\UserRegister\Domain\User\User;
use SocialMedia\UserRegister\Domain\User\UserId;
use SocialMedia\UserRegister\Domain\User\UserIsVisible;
use SocialMedia\UserRegister\Domain\User\UserRepository;
use SocialMedia\UserRegister\Domain\User\UserName;
use Doctrine\DBAL\Connection;

class DbalUserRepository implements UserRepository
{
    private const DATE_FORMAT = "Y-m-d\TH:i";

    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getUserByName(UserName $userName): ?User
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM users WHERE user_name = :user_name 
        ');

        $stmt->bindValue('user_name', $userName->getName());
        $stmt->execute();

        $result = $stmt->fetchAssociative();

        if (!$result) {
            return null;
        }

        return User::create(
            UserId::fromString($result['id']),
            Password::fromString($result['password']),
            UserName::create($result['user_name']),
            \DateTimeImmutable::createFromFormat(self::DATE_FORMAT, $result['crated_at']),
            UserIsVisible::fromString($result['is_visible'])
        );
    }

    public function store(User $user): void
    {
        $stmt = $this->connection->prepare('
            INSERT INTO users (id, user_name,password, created_at, is_visible)
            VALUES (:id, :user_name, :password, :created_at, is_visible) 
        ');

        $stmt->bindValue('id', $user->getId()->toString());
        $stmt->bindValue('user_name', $user->userName()->getName());
        $stmt->bindValue('password', $user->getPassword()->getPassword());
        $stmt->bindValue('created_at', $user->getCreatedAt()->format(self::DATE_FORMAT));
        $stmt->bindValue('is_visible', $user->getIsVisible()->getIsVisible());

        $stmt->execute();
    }


}
