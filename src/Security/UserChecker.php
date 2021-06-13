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

namespace LongitudeOne\BannedBundle\Security;

use LongitudeOne\BannedBundle\Exception\BannedUserMessageAuthenticationException;
use LongitudeOne\BannedBundle\Entity\BannedInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    /**
     * {@inheritDoc}
     */
    public function checkPostAuth(UserInterface $user)
    {
        //Not used, but shall be created
    }

    /**
     * {@inheritDoc}
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
}
