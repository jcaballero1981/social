<?php

namespace SocialMedia\UserRegister\Domain\User;

class User
{
    private UserId $userId;
    private Password $password;
    private UserName $userName;
    private \DateTimeImmutable $createdAt;

    private function __construct(
        UserId $userId,
        Password $password,
        UserName $userName,
        \DateTimeImmutable $createdAt
    )
    {
        $this->userId = $userId;
        $this->password = $password;
        $this->userName = $userName;
        $this->createdAt = $createdAt;
    }

    public static function create(
        UserId $userId,
        Password $password,
        UserName $userName,
        \DateTimeImmutable $createdAt
    ): self
    {
        return new self($userId, $password, $userName, $createdAt);
    }


    public function getId(): UserId
    {
        return $this->userId;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function userName(): UserName
    {
        return $this->userName();
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }


}