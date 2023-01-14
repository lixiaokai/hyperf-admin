<?php

declare(strict_types=1);

namespace App\Admin\Collection\Rbac;

use Core\Resource\BaseCollection;

/**
 * 角色管理 - 列表 - 集合.
 */
class RoleCollection extends BaseCollection
{
    public $collects = RoleResource::class;

    public function toArray(): array
    {
        return $this->collection->toArray();
    }
}
