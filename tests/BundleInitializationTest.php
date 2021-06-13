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
use Nyholm\BundleTest\BaseBundleTestCase;

/**
 * @internal
 */
class BundleInitializationTest extends BaseBundleTestCase
{
    public function testInitBundle(): void
    {
        // Boot the kernel.
        $this->bootKernel();

        // Get the container
        $container = $this->getContainer();

        // Test if you services exists
        $this->assertTrue($container->has('lo_banned.user_checker'));
        $service = $container->get('lo_banned.user_checker');
        $this->assertInstanceOf(UserChecker::class, $service);
    }

    /**
     * {@inheritDoc}
     */
    protected function getBundleClass(): string
    {
        return LongitudeOneBannedBundle::class;
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
