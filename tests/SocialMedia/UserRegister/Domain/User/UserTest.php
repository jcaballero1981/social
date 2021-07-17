<?php

namespace Tests\SocialMedia\UserRegister\Domain\User;

use SocialMedia\UserRegister\Domain\User\Exception\UserNameContainsInvalidChars;
use SocialMedia\UserRegister\Domain\User\User;
use SocialMedia\UserRegister\Domain\User\UserId;
use SocialMedia\UserRegister\Domain\User\Exception\UserNameLengthInvalid;
use SocialMedia\UserRegister\Domain\User\Password;
use SocialMedia\UserRegister\Domain\User\UserIsVisible;
use SocialMedia\UserRegister\Domain\User\UserName;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Exception\InvalidPasswordException;

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
        $isVisible= UserIsVisible::create();


        $user = User::create(
            $userId,
            $password,
            $userName,
            $createdAt,
            $isVisible
        );

        static::assertSame($userId, $user->getId());
        static::assertSame($password ,$user->getPassword());
        static::assertSame($userName, $user->getUserName());
        static::assertSame($createdAt, $user->getCreatedAt());
        static::assertTrue($user->getIsVisible()->getIsVisible(),"assert user is visible or not");
    }

    /**
     * @test
     * @expectedException UserNameLengthInvalid
     */
    public function it_should_fail_when_name_is_shorter_than_five(): void
    {
        UserName::create('jos');
    }

    /**
     * @test
     * @expectedException UserNameLengthInvalid
     */
    public function it_should_fail_when_name_is_longer_than_ten(): void
    {
        UserName::create('josfdfdfdfdfdfd');
    }

    /**
     * @test
     * @dataProvider inavalidNamesProvider
     * @expectedException UserNameContainsInvalidChars
     */
    public function it_should_fail_when_name_contains_non_alphanumerics($name): void
    {
        UserName::create($name);
    }

    public function inavalidNamesProvider(): array
    {
        return [
           ".joseph",
           ",joseph",
           "_joseph",
        ];
    }



    /**
     * @test
     * @expectedException InvalidPasswordException
     */
    public function it_should_fail_when_password_is_shorter_than_eight(): void
    {
        UserName::create('1234567');
    }

    /**
     * @test
     * @expectedException InvalidPasswordException
     */
    public function it_should_fail_when_password_is_longer_than_tuelve(): void
    {
        UserName::create('1234567891234');
    }


    /**
     * @test
     * @dataProvider inavalidPasswordProvider
     * @expectedException InvalidPasswordException
     */
    public function it_should_fail_when_password_contains_non_alphanumerics($password): void
    {
        Password::generate($password);
    }

    public function inavalidPaswordProvider(): array
    {
        return [
            ".mysecret",
            ",mysecret",
            "_mysecret",
        ];
    }





}
