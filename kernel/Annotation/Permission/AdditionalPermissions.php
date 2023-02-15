<?php

namespace Kernel\Annotation\Permission;

use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * 附加权限路由 - 注解.
 *
 * @Annotation
 * @Target({"METHOD"})
 */
class AdditionalPermissions extends AbstractAnnotation
{
    /**
     * @var array|string
     */
    public $routes;
}
