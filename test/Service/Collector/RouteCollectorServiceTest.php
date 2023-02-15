<?php

namespace HyperfTest\Service\Collector;

use Kernel\Service\Collector\RouteCollectorService;
use PHPUnit\Framework\TestCase;

class RouteCollectorServiceTest extends TestCase
{
    /**
     * @see RouteCollectorService::init()
     */
    public function testInit()
    {
        make(RouteCollectorService::class)->init();

        self::assertTrue(true);
    }

    /**
     * @see RouteCollectorService::getRoutes()
     */
    public function testGetRoutes()
    {
        $routes = make(RouteCollectorService::class)->getRoutes();

        self::assertIsArray($routes);
        self::assertTrue(true);
    }

    public function testGetAdditionalPermissions()
    {
        make(RouteCollectorService::class)->getAdditionalPermissions();

        self::assertTrue(true);
    }
}
