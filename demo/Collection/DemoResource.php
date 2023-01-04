<?php

declare(strict_types=1);

namespace Demo\Collection;

use App\Model\User;
use Kernel\Resource\BaseResource;

/**
 * 演示 - 列表 - 资源.
 *
 * @property User $resource
 */
class DemoResource extends BaseResource
{
    public function toArray(): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
        ];
    }
}
