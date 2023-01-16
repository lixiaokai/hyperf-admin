<?php

namespace Core\Model\Traits;

use Core\Model\Role;

trait UserActionTrail
{
    /**
     * 是否 - 超级管理员.
     */
    public function isSuperAdmin(): bool
    {
        return $this->roles->contains(Role::SUPER_ADMIN_ID);
    }

    /**
     * 能否 - 删除.
     */
    public function canDelete(): bool
    {
        return false;
    }
}
