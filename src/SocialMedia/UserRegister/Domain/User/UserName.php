<?php

namespace SocialMedia\UserRegister\Domain\User;


use SocialMedia\UserRegister\Domain\User\Exception\UserNameLengthInvalid;
use SocialMedia\UserRegister\Domain\User\Exception\UserNameContainsInvalidChars;

class UserName
{
    private const NAME_MAX_CHAR_LENGTH = 10;
    private const NAME_MIN_CHAR_LENGTH = 5;
    private  string $name;

    

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function create($name): self
    {
        if (empty($name)) {
            throw new UserNameLengthInvalid(
                \sprintf("Name is not valid")
            );
        }
        if (strlen($name)>self::NAME_MAX_CHAR_LENGTH) {
            throw new UserNameLengthInvalid(
                \sprintf("Name is too long")
            );
        }
        if (strlen($name)<self::NAME_MIN_CHAR_LENGTH) {
            throw new UserNameLengthInvalid(
                \sprintf("Name is too short")
            );
        }

        if (!ctype_alnum($name)) {
            throw new UserNameContainsInvalidChars(
                \sprintf("Username contains none alphanumeric chars")
            );
        }

        return new self( $name);
    }

    public function getName(){
        return $this->name;
    }

}