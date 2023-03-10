<?php

namespace Core\Model\Traits;

trait RoleActionTrail
{
    /**
     * 是否 - 超级管理员角色.
     */
    public function isSuperAdmin(): bool
    {
        return $this->id === self::SUPER_ADMIN_ID;
    }

    /**
     * 能否 - 删除.
     */
    public function canDelete(): bool
    {
        return false;
    }
}
