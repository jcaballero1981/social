<?php

namespace SocialMedia\UserRegister\Domain\User;

class User
{
    private UserId $userId;
    private Password $password;
    private UserName $userName;
    private \DateTimeImmutable $createdAt;
    private  UserIsVisible $isVisible;

    private function __construct(
        UserId $userId,
        Password $password,
        UserName $userName,
        \DateTimeImmutable $createdAt,
        UserIsVisible $isVisible
    )
    {
        $this->userId = $userId;
        $this->password = $password;
        $this->userName = $userName;
        $this->createdAt = $createdAt;
        $this->isVisible = $isVisible;
    }

    public static function create(
        UserId $userId,
        Password $password,
        UserName $userName,
        \DateTimeImmutable $createdAt,
        UserIsVisible $isVisible
    ): self
    {
        return new self($userId, $password, $userName, $createdAt, $isVisible);
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
        return $this->userName;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getIsVisible(): UserIsVisible
    {
        return $this->isVisible;
    }


}