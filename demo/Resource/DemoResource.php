<?php

declare(strict_types=1);

namespace Demo\Resource;

use Kernel\Resource\BaseResource;

/**
 * 演示 - 详情 - 资源.
 *
 * @property array $resource
 */
class DemoResource extends BaseResource
{
    public function toArray(): array
    {
        return [
            'id' => data_get($this->resource, 'id'),
            'name' => data_get($this->resource, 'name'),
        ];
    }
}
