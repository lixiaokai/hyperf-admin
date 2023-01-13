<?php

declare(strict_types=1);

namespace Core\Model;

use Carbon\Carbon;

/**
 * 角色用户关系 - 模型.
 *
 * @property int    $id        自增 ID
 * @property int    $roleId    角色 ID
 * @property int    $userId    用户 ID
 * @property Carbon $createdAt 创建时间
 */
class RoleUser extends BaseModel
{
    public const UPDATED_AT = null;

    protected $table = 'role_user';

    protected $fillable = ['id', 'role_id', 'user_id', 'created_at'];

    protected $casts = ['id' => 'integer', 'role_id' => 'integer', 'user_id' => 'integer', 'created_at' => 'datetime'];
}
