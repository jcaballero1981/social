<?php

namespace SocialMedia\UserRegister\Domain\User;


class UserIsVisible
{

    private  bool $isVisible;

    

    private function __construct(bool $isVisible)
    {
        $this->isVisible = $isVisible;
    }

    public static function create(): self
    {

        return new self( true);
    }

    public static function fromString(string $isVisible): self
    {
        $string = strtolower($isVisible);
        $boolValue= (in_array($string, array("true", "false", "1", "0", "yes", "no"), true));
        if (false ===$boolValue) {
            throw new \DomainException(
                \sprintf("Visibility is not a boolean", $isVisible)
            );
        }

        return new self((bool)$isVisible);
    }

    public function getIsVisible(){
        return $this->isVisible;
    }

}