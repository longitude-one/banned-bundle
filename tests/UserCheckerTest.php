<?php


use LongitudeOne\BannedBundle\Entity\BannedInterface;
use LongitudeOne\BannedBundle\Exception\BannedUserMessageAuthenticationException;
use LongitudeOne\BannedBundle\Security\UserChecker;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\User\UserInterface;

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
        self::expectExceptionMessage('error.user-banned');
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

class StandardUser implements UserInterface
{
    private bool $banned;

    public function __construct(bool $banned = false)
    {
        $this->banned = $banned;
    }
    public function isBanned(): bool
    {
        return $this->banned;
    }

    public function eraseCredentials()
    {
    }

    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    public function getPassword()
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

    public function __call(string $name, array $arguments)
    {
    }
}

class BannedUser extends StandardUser implements BannedInterface, UserInterface
{
}
