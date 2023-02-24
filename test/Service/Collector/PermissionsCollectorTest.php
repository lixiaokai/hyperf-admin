<?php

namespace HyperfTest\Service\Collector;

use Core\Service\Collector\PermissionsCollector;
use PHPUnit\Framework\TestCase;

class PermissionsCollectorTest extends TestCase
{
    /**
     * @see PermissionsCollector::handle()
     */
    public function testHandle()
    {
        make(PermissionsCollector::class)->handle();

        self::assertTrue(true);
    }

    /**
     * @see PermissionsCollector::getAdditionalPermissions()
     */
    public function testGetAdditionalPermissions()
    {
        $res = PermissionsCollector::getAttachPermissions();
        var_dump($res);

        self::assertTrue(true);
    }
}
