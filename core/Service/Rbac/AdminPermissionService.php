<?php

namespace Core\Service\Rbac;

use Core\Constants\ContextKey;
use Core\Service\BaseService;
use Hyperf\Context\Context;
use Kernel\Constants\ErrorCode;
use Kernel\Exception\BusinessException;

/**
 * 总后台权限 - 服务类.
 */
class AdminPermissionService extends BaseService
{
    /**
     * 权限 - 检查.
     */
    public function check(string $method, string $route): void
    {
        $route = $method . ':' . $route;
        $admin = Context::get(ContextKey::ADMIN);

        if ($admin->can($route) === false) {
            throw new BusinessException(null, ErrorCode::FORBIDDEN);
        }
    }
}
