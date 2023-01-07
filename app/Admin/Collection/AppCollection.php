<?php

declare(strict_types=1);

namespace App\Admin\Collection;

use Core\Resource\BaseCollection;

/**
 * 应用 - 列表 - 集合.
 */
class AppCollection extends BaseCollection
{
    public $collects = AppResource::class;
}
