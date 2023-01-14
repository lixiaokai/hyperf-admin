<?php

declare(strict_types=1);

namespace App\Admin\Resource\Rbac;

use Core\Model\Menu;
use Core\Resource\BaseResource;
use Kernel\Helper\FormatHelper;

/**
 * 菜单管理 - 详情 - 资源.
 *
 * @property Menu $resource
 */
class MenuResource extends BaseResource
{
    public function toArray(): array
    {
        return [
            'id' => $this->resource->id, // 菜单 ID
            'parentId' => $this->resource->parentId, // 父 ID
            'platform' => $this->resource->platform, // 终端平台 Key
            'platformText' => $this->resource->platformText, // 终端平台 - 文字
            'appId' => $this->resource->appId ?? '', // 应用 ID
            'appName' => \data_get($this->resource->app, 'name', ''), // 应用名称
            'method' => $this->resource->method ?? '', // 请求方式
            'uri' => $this->resource->uri ?? '', // 路由 uri
            'name' => $this->resource->name, // 菜单名称
            'remark' => $this->resource->remark ?? '', // 菜单备注
            'icon' => $this->resource->icon ?? '', // 图标
            'type' => $this->resource->type, // 类型
            'typeText' => $this->resource->typeText, // 类型 - 文字
            'status' => $this->resource->status, // 状态
            'statusText' => $this->resource->statusText, // 状态 - 文字
            'sort' => $this->resource->sort, // 排序
            'created_at' => FormatHelper::toDateTimeString($this->resource->createdAt), // 创建时间
            'updated_at' => FormatHelper::toDateTimeString($this->resource->updatedAt), // 修改时间
        ];
    }
}
