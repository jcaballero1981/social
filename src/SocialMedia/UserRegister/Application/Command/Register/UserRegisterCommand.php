<?php declare(strict_types=1);

namespace SocialMedia\UserRegister\Application\Command\Register;

use SocialMedia\UserRegister\Application\Command\Command;

class UserRegisterCommand implements Command
{
    private string $userName;
    private string $password;


    public function __construct(
        string $userName,
        string $password
    )
    {
        $this->userName = $userName;
        $this->password = $password;
    }


    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

}
