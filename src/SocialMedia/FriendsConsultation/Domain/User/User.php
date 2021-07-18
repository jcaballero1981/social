<?php

namespace SocialMedia\FriendsConsultation\Domain\User;

class User
{
    private UserId $userId;
    private UserName $userName;


    private function __construct(
        UserId $userId,
        UserName $userName
    )
    {
        $this->userId = $userId;
        $this->userName = $userName;
    }

    public static function create(
        UserId $userId,
        UserName $userName
    ): self
    {
        return new self($userId, $userName);
    }


    public function getId(): UserId
    {
        return $this->userId;
    }



    public function userName(): UserName
    {
        return $this->userName;
    }

}