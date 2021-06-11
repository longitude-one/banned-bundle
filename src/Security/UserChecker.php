<?php

namespace LongitudeOne\BannedBundle\Security;

use LongitudeOne\BannedBundle\Exception\BannedUserMessageAuthenticationException;
use LongitudeOne\BannedBundle\Entity\BannedInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    /**
     * @inheritDoc
     */
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof BannedInterface) {
            return;
        }

        if ($user->isBanned()) {
            throw new BannedUserMessageAuthenticationException($user);
        }
    }

    /**
     * @inheritDoc
     */
    public function checkPostAuth(UserInterface $user)
    {
        // TODO: Implement checkPostAuth() method.
    }
}