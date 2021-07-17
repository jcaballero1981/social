<?php declare(strict_types=1);

namespace SocialMedia\UserRegister\Application\Command;

interface Handler
{
    public function __invoke(Command $command): void;
}
