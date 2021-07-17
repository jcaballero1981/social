<?php

namespace App\Tests\SocialMedia\UserRegister\Application\Command\Register;

use SocialMedia\UserRegister\Application\Command\Register\UserRegisterCommand;
use SocialMedia\UserRegister\Application\Command\Register\UserRegisterCommandHandler;
use SocialMedia\UserRegister\Domain\User\UserRegisterService;
use Tests\SocialMedia\UserRegister\Doubles\InMemoryUserRepository;
use PHPUnit\Framework\TestCase;

class UserRegisterTest extends TestCase
{
    public function test_an_user_can_be_created(): void
    {
        $userName='joseph';
        $password='joseph1234';

        $command = new UserRegisterCommand(
            $userName,
            $password
        );

        $repository = new InMemoryUserRepository();

        $handler = new UserRegisterCommandHandler(new UserRegisterService($repository));
        $handler($command);

        $user = $repository->getUserByName($userName);
        static::assertSame($userName, $user->getUserName());
        static::assertSame(password_hash($password, PASSWORD_DEFAULT), $user->getPassword()->getPassword());
    }
}
