<?php

namespace Tests\SocialMedia\FriendsConsultation\Domain\User;


use SocialMedia\FriendsConsultation\Domain\User\User;
use SocialMedia\FriendsConsultation\Domain\User\UserId;
use SocialMedia\FriendsConsultation\Domain\User\Exception\UserNameLengthInvalid;
use SocialMedia\FriendsConsultation\Domain\User\UserName;
use PHPUnit\Framework\TestCase;


class UserTest extends TestCase
{
    public function test_an_user_can_be_created(): void
    {
        $userId = UserId::generate();
        $userName = UserName::create('josep');

        $user = User::create(
            $userId,
            $userName
        );

        static::assertSame($userId, $user->getId());
        static::assertSame($userName, $user->getUserName());
    }

    /**
     * @test
     * @expectedException UserNameLengthInvalid
     */
    public function it_should_fail_when_name_is_empty(): void
    {
        UserName::create('');
    }






}
