<?php

declare(strict_types=1);

namespace App\Demo\Resource;

use Core\Model\Attachment;
use Core\Resource\BaseResource;
use Kernel\Helper\FormatHelper;

/**
 * 演示 - 详情 - 资源.
 *
 * @property Attachment $resource
 */
class FileResource extends BaseResource
{
    public function toArray(): array
    {
        return [
            'id' => $this->resource->id,
            'userId' => $this->resource->userId,
            'storageMode' => $this->resource->storageMode,
            'name' => $this->resource->name,
            'type' => $this->resource->type,
            'size' => $this->resource->size,
            'path' => $this->resource->path,
            'pullPath' => $this->resource->fullPath,
            'hash' => $this->resource->hash,
            'createdAt' => FormatHelper::toDateTimeString($this->resource->createdAt),
            'updatedAt' => FormatHelper::toDateTimeString($this->resource->updatedAt),
            'deletedAt' => FormatHelper::toDateTimeString($this->resource->deletedAt),
        ];
    }
}
