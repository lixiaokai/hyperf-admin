<?php

namespace Core\Model\Traits;

trait RoleActionTrail
{
    /**
     * 能否 - 删除.
     */
    public function canDelete(): bool
    {
        return false;
    }
}
