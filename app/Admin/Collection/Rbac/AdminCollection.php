<?php

declare(strict_types=1);

namespace App\Admin\Collection\Rbac;

use Core\Resource\BaseCollection;

/**
 * 用户管理 - 列表 - 集合.
 */
class AdminCollection extends BaseCollection
{
    public $collects = AdminResource::class;
}
