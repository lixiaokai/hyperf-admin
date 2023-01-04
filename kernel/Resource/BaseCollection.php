<?php

declare(strict_types=1);

namespace Kernel\Resource;

use Hyperf\Resource\Json\ResourceCollection;

/**
 * API 集合 - 基类.
 */
class BaseCollection extends ResourceCollection
{
    /**
     * 附加元数据.
     */
    public $additional = [
        'code' => 200,
        'message' => '',
    ];

    /**
     * 附加顶层元数据.
     */
    public array $addToWith = [];

    public function __construct($resource)
    {
        parent::__construct($resource);

        // 附加顶层元数据
        foreach ($this->addToWith as $item) {
            $item && method_exists($this, $item) && $this->with[$item] = $this->{$item}();
        }
    }

    public function toArray(): array
    {
        return [
            'items' => $this->collection,
        ];
    }
}
