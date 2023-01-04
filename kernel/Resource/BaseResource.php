<?php

declare(strict_types=1);

namespace Kernel\Resource;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Resource\Json\JsonResource;

/**
 * API 资源 - 基类.
 *
 * 添加额外的数据到顶层：
 * 例如：
 * public array $addToWith = ['acl'];
 * public function acl()
 * {
 *   return [
 *      'canUpdate' => true,
 *      'canDelete' => true,
 *   ];
 * }
 * 输出：
 * {
 *   "data": {
 *     "id": 1
 *   },
 *   "acl": {
 *     "canUpdate": true,
 *     "canDelete": true
 *   },
 *   "code": 200,
 *   "message": "ok"
 * }
 */
class BaseResource extends JsonResource
{
    /**
     * @Inject
     */
    public RequestInterface $request;

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
}
