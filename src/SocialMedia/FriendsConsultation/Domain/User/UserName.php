<?php

namespace SocialMedia\FriendsConsultation\Domain\User;


use SocialMedia\FriendsConsultation\Domain\User\Exception\UserNameLengthInvalid;


class UserName
{
    private  string $name;

    

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function create($name): self
    {
        if (empty($name)) {
            throw new UserNameLengthInvalid(
                \sprintf("Username is empty")
            );
        }


        return new self( $name);
    }

    public function getName(){
        return $this->name;
    }

}