<?php


namespace SocialMedia\UserRegister\Domain\User;


use Symfony\Component\PasswordHasher\Exception\InvalidPasswordException;

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

        if (!ctype_alnum($password)) {
            throw new InvalidPasswordException(
                \sprintf("Password contains none alphanumeric chars")
            );
        }

        return new self( password_hash($password, PASSWORD_DEFAULT));
    }

    public static function fromString(string $password): self
    {

        return new self($password);
    }


    public function getPassword(): string
    {
        return $this->password;
    }



}