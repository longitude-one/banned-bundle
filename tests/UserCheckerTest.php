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

use LongitudeOne\BannedBundle\Entity\BannedInterface;
use LongitudeOne\BannedBundle\Exception\BannedUserMessageAuthenticationException;
use LongitudeOne\BannedBundle\Security\UserChecker;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @internal
 */
class UserCheckerTest extends TestCase
{
    private UserChecker $userChecker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userChecker = new UserChecker();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->userChecker);
    }

    public function testCheckPreAuthWithBannedUser()
    {
        self::expectException(BannedUserMessageAuthenticationException::class);
        self::expectExceptionCode(0);
        self::expectExceptionMessage('error.banned');
        $user = new BannedUser(true);
        $this->userChecker = new UserChecker();
        $this->userChecker->checkPreAuth($user);
    }

    public function testCheckPreAuthWithNonBannedUser()
    {
        $user = new BannedUser(false);
        $this->userChecker = new UserChecker();
        $this->userChecker->checkPreAuth($user);
        self::assertTrue(true, 'If this code is reached, then no exception were thrown.');
    }

    public function testCheckPreAuthWithUserNonImplementingBanned()
    {
        $user = new StandardUser(true);
        $this->userChecker = new UserChecker();
        $this->userChecker->checkPreAuth($user);
        self::assertTrue(true, 'If this code is reached, then no exception were thrown.');
    }
}

/**
 * @internal
 */
class StandardUser implements UserInterface
{
    private bool $banned;

    public function __construct(bool $banned = false)
    {
        $this->banned = $banned;
    }

    public function eraseCredentials()
    {
    }

    public function getPassword()
    {
    }

    public function getRoles()
    {
    }

    public function getSalt()
    {
    }

    public function getUserIdentifier(): string
    {
        return '';
    }

    public function getUsername()
    {
    }

    public function isBanned(): bool
    {
        return $this->banned;
    }

    public function __call(string $name, array $arguments)
    {
    }
}

/**
 * @internal
 */
class BannedUser extends StandardUser implements BannedInterface, UserInterface
{
}
