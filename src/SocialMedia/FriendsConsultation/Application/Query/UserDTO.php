<?php

namespace SocialMedia\FriendsConsultation\Application\Query;

class UserDTO
{

    private string $userName;

    public function __construct(
        string $userName
    )
    {
        $this->userName = $userName;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

}
