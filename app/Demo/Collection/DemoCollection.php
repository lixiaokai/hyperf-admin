<?php

declare(strict_types=1);

namespace App\Demo\Collection;

use Core\Resource\BaseCollection;

/**
 * 演示 - 列表 - 集合.
 */
class DemoCollection extends BaseCollection
{
    public $collects = DemoResource::class;
}
