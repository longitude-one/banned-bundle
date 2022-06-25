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

namespace LongitudeOne\BannedBundle\Tests;

use LongitudeOne\BannedBundle\LongitudeOneBannedBundle;
use LongitudeOne\BannedBundle\Security\UserChecker;
use Nyholm\BundleTest\TestKernel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @internal
 */
class BundleInitializationTest extends KernelTestCase
{
    public function testInitBundle(): void
    {
        // Boot the kernel.
        $kernel = self::bootKernel();

        // Get the container
        $container = $kernel->getContainer();

        // Test if you services exists
        $this->assertTrue($container->has('lo_banned.user_checker'));
        $service = $container->get('lo_banned.user_checker');
        $this->assertInstanceOf(UserChecker::class, $service);
    }

    protected static function createKernel(array $options = []): KernelInterface
    {
        /**
         * @var TestKernel $kernel
         */
        $kernel = parent::createKernel($options);
        $kernel->addTestBundle(LongitudeOneBannedBundle::class);
        $kernel->handleOptions($options);

        return $kernel;
    }

    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }

//    public function testBundleWithDifferentConfiguration()
//    {
//        // Create a new Kernel
//        $kernel = $this->createKernel();
//
//        // Add some configuration
//        $kernel->addConfigFile(__DIR__.'/config.yml');
//
//        // Add some other bundles we depend on
//        $kernel->addBundle(OtherBundle::class);
//
//        // Boot the kernel as normal ...
//        $this->bootKernel();
//
//        // ...
//    }
}
