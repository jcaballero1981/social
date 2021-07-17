<?php

namespace Tests\SocialMedia\UserRegister\Domain\User;

use SocialMedia\UserRegister\Domain\User\Password;
use SocialMedia\UserRegister\Domain\User\User;
use SocialMedia\UserRegister\Domain\User\UserId;
use SocialMedia\UserRegister\Domain\User\UserIsVisible;
use SocialMedia\UserRegister\Domain\User\UserRegisterService;
use PHPUnit\Framework\TestCase;
use SocialMedia\UserRegister\Domain\User\UserName;
use Tests\SocialMedia\UserRegister\Doubles\InMemoryUserRepository;

class UserRegisterServiceTest extends TestCase
{
    public function test_an_user_account_can_be_created(): void
    {
        $repository = new InMemoryUserRepository();
        $service = new UserRegisterService($repository);

        $userName = UserName::create('Joseph') ;

        $isVisible= UserIsVisible::create();

        $user = User::create(
            UserId::generate(),
            Password::generate('mysecret'),
            $userName,
            new \DateTimeImmutable(),
            $isVisible
        );

        $service->confirmRegister($user);

        static::assertSame($user, $repository->getUserByName($userName));
    }

}
