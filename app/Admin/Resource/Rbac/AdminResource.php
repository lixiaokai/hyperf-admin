<?php

declare(strict_types=1);

namespace App\Admin\Resource\Rbac;

use Core\Model\Admin;
use Core\Resource\BaseResource;
use Kernel\Helper\FormatHelper;

/**
 * 用户管理 - 列表 - 资源.
 *
 * @property Admin $resource
 */
class AdminResource extends BaseResource
{
    public function toArray(): array
    {
        return [
            'id' => $this->resource->id, // ID
            'name' => $this->resource->name, // 名称
            'phone' => $this->resource->phone ?? '', // 手机
            'status' => $this->resource->user->status, // 状态
            'statusText' => $this->resource->user->statusText, // 状态 - 文字
            'created_at' => FormatHelper::toDateTimeString($this->resource->createdAt), // 创建时间
            'updated_at' => FormatHelper::toDateTimeString($this->resource->updatedAt), // 修改时间
        ];
    }
}
