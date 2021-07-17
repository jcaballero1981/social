<?php declare(strict_types=1);

namespace SocialMedia\UserRegister\Application\Command\Register;

use SocialMedia\UserRegister\Application\Command\Command;
use SocialMedia\UserRegister\Application\Command\Handler;
use SocialMedia\UserRegister\Domain\User\Password;
use SocialMedia\UserRegister\Domain\User\User;
use SocialMedia\UserRegister\Domain\User\UserId;
use SocialMedia\UserRegister\Domain\User\Exception\CouldNotConfirmRegistrationException;
use SocialMedia\UserRegister\Domain\User\UserIsVisible;
use SocialMedia\UserRegister\Domain\User\UserName;
use SocialMedia\UserRegister\Domain\User\UserRegisterService;

class UserRegisterCommandHandler implements Handler
{
    private userRegisterService $userRegisterService;

    public function __construct(UserRegisterService $userRegisterService)
    {
        $this->userRegisterService = $userRegisterService;
    }

    public function __invoke(Command $command): void
    {
        $user = User::create(
            UserId::generate(),
            Password::generate($command->getPassword()),
            UserName::create($command->getUserName()),
            new \DateTimeImmutable(),
            UserIsVisible::create()
        );

        try {
            $this->userRegisterService->confirmRegister($user);
        } catch (CouldNotConfirmRegistrationException $couldNotConfirmRegistrationException) {
            throw new \RuntimeException("The user could not be registered");
        }
    }
}
