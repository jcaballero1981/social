<?php

namespace SocialMedia\FriendsConsultation\Infrastructure;


use SocialMedia\FriendsConsultation\Domain\User\User;
use SocialMedia\FriendsConsultation\Domain\User\UserId;

use SocialMedia\FriendsConsultation\Domain\User\UserRepository;
use SocialMedia\FriendsConsultation\Domain\User\UserName;
use Doctrine\DBAL\Connection;

class DbalUserRepository implements UserRepository
{


    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getUserFriends(string $userId): array
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM friends where user_id=:user_id and user_is_visible is true 
        ');

        $stmt->bindValue('user_id', $userId);

        $stmt->execute();

        $result = $stmt->fetchAllAssociative();

        return \array_map(function (array $row) {
            return User::create(
                UserId::fromString($row['id']),
                UserName::fromString($row['username'])
            );
        }, $result);
    }

}
