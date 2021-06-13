<?php
/**
 * This file is part of the Banned Bundle.
 *
 * PHP 7.4 | 8.0
 *
 * (c) Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * (c) Longitude One 2020 - 2021
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

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
