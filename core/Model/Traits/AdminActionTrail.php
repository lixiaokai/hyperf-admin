<?php

declare(strict_types=1);

namespace Core\Model\Traits;

trait AdminActionTrail
{
    /**
     * 是否有权限.
     */
    public function can(string $route): bool
    {
        static $permission;

        if (empty($routers)) {
            $permission = $this->getPermissions();
        }

        return $permission->contains('route', $route);
    }
}
