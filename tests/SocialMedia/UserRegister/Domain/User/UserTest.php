<?php

namespace Tests\SocialMedia\UserRegister\Domain\User;

use SocialMedia\UserRegister\Domain\User\User;
use SocialMedia\UserRegister\Domain\User\UserId;
use SocialMedia\UserRegister\Domain\User\Exception\UserNameLengthInvalid;
use SocialMedia\UserRegister\Domain\User\Password;
use SocialMedia\UserRegister\Domain\User\UserName;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_an_user_can_be_created(): void
    {
        $userId = UserId::generate();
        $password = Password::generate(
            'mysecret'
        );
        $userName = UserName::create('josep');
        $createdAt = new \DateTimeImmutable();


        $user = User::create(
            $userId,
            $password,
            $userName,
            $createdAt
        );

        static::assertSame($userId, $user->getId());
        static::assertSame($password ,$user->getPassword());
        static::assertSame($userName, $user->getUserName());
        static::assertSame($createdAt, $user->getCreatedAt());
    }

    /**
     * @test
     * @expectedException \OutOfBoundsException
     */
    public function it_should_fail_when_name_is_shorter_than_five(): void
    {
        UserName::create('jos');
        $this->expectException(UserNameLengthInvalid::class);
    }





}
