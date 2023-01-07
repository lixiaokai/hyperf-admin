<?php

declare(strict_types=1);

namespace App\Admin\Resource;

use Core\Model\App;
use Core\Resource\BaseResource;
use Kernel\Helper\FormatHelper;

/**
 * 应用 - 详情 - 资源.
 *
 * @property App $resource
 */
class AppResource extends BaseResource
{
    public function toArray(): array
    {
        return [
            'id' => $this->resource->id, // 应用 ID
            'key' => $this->resource->key, // 应用 Key
            'name' => $this->resource->name, // 应用名称
            'sort' => $this->resource->sort, // 排序
            'status' => $this->resource->status, // 状态
            'statusText' => $this->resource->statusText, // 状态 - 文字
            'created_at' => FormatHelper::toDateTimeString($this->resource->createdAt), // 创建时间
            'updated_at' => FormatHelper::toDateTimeString($this->resource->updatedAt), // 修改时间
        ];
    }
}
