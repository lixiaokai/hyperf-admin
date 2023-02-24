<?php

namespace HyperfTest\Service\Collector;

use Core\Service\Collector\RoutesCollector;
use Hyperf\Utils\Collection;
use PHPUnit\Framework\TestCase;

class RoutesCollectorTest extends TestCase
{
    /**
     * @see RoutesCollector::handle()
     */
    public function testHandle()
    {
        $res = make(RoutesCollector::class)->handle();
        var_dump($res);

        self::assertInstanceOf(Collection::class, $res);
    }
}
