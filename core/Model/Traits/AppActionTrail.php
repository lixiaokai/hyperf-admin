<?php

namespace Core\Model\Traits;

trait AppActionTrail
{
    /**
     * 能否 - 删除.
     */
    public function canDelete(): bool
    {
        return false;
    }
}
