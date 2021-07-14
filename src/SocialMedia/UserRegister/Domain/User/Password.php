<?php


namespace SocialMedia\UserRegister\Domain\User;


class Password
{

    private string $password;

    private function __construct(string $password)
    {
        $this->password = $password;
    }

    public static function generate($password): self
    {
        if (empty($password)) {
            throw new \DomainException(\sprintf("Password is not valid"));
        }
        return new self( password_hash($password, PASSWORD_DEFAULT));
    }



}