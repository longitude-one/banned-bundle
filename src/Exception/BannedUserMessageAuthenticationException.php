<?php

namespace LongitudeOne\BannedBundle\Exception;

use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;

class BannedUserMessageAuthenticationException extends CustomUserMessageAuthenticationException
{
    public const MESSAGE_USER_BANNED = 'error.user-banned';

    public function __construct(UserInterface $user)
    {
        parent::__construct(self::MESSAGE_USER_BANNED, ['user' => $user], 0, null);
    }
}
