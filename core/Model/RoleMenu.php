<?php

declare(strict_types=1);

namespace Core\Model;

use Carbon\Carbon;

/**
 * 角色权限菜单关系 - 模型.
 *
 * @property int    $id        自增 ID
 * @property int    $roleId    角色 ID
 * @property int    $menuId    权限菜单 ID
 * @property Carbon $createdAt 创建时间
 */
class RoleMenu extends BaseModel
{
    public const UPDATED_AT = null;

    protected $table = 'role_menu';

    protected $fillable = ['id', 'role_id', 'menu_id', 'created_at'];

    protected $casts = ['id' => 'integer', 'role_id' => 'integer', 'menu_id' => 'integer', 'created_at' => 'datetime'];
}
