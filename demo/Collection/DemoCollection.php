<?php

declare(strict_types=1);

namespace Demo\Collection;

use Kernel\Resource\BaseCollection;

/**
 * 演示 - 列表 - 集合.
 */
class DemoCollection extends BaseCollection
{
    public $collects = DemoResource::class;
}
