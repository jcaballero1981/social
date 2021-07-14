<?php

namespace SocialMedia\UserRegister\Domain\User;

use SocialMedia\UserRegister\Domain\User\Exception\CouldNotConfirmRegistrationException;

class UserRegisterService

{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function confirmRegister(User $user): void
    {
        $this->checkUserNameIsNotTaken($user);
        $this->userRepository->store($user);
    }



    private function checkUserNameIsNotTaken(User $user): void
    {
        $existingUser = $this->userRepository->getUserByName(
            $user->userName()
        );

        if (null !== $existingUser) {
            throw new CouldNotConfirmRegistrationException("The username is already taken");
        }
    }

}