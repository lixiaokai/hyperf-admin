<?php

declare(strict_types=1);

namespace Core\Model\Admin;

use Carbon\Carbon;
use Core\Model\BaseModel;
use Core\Model\Traits\RoleActionTrail;
use Core\Model\Traits\StatusTrait;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Relations\BelongsToMany;

/**
 * 角色 - 模型.
 *
 * @property int    $id        角色 ID
 * @property string $name      名称
 * @property string $remark    备注
 * @property int    $sort      排序
 * @property string $status    状态 ( enable-启用 disable-禁用 )
 * @property Carbon $createdAt 创建时间
 * @property Carbon $updatedAt 修改时间
 *
 * @property string $platformKey 终端平台 - key
 * @property string $typeText    类型 - 文字
 *
 * @property Collection|Permission[] $permissions 权限 ( 多条 )
 * @property Admin[]|Collection      $admins      总后台用户 ( 多条 )
 *
 * @see RoleTest::class
 */
class Role extends BaseModel
{
    use StatusTrait;
    use RoleActionTrail;

    /**
     * 超级管理员角色 ID.
     *
     * 说明：该角色拥有总后台所有权
     */
    public const SUPER_ADMIN_ID = 1;

    protected $table = 'role';

    protected $fillable = [
        'id',
        'parent_id',
        'name',
        'remark',
        'sort',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'sort' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    /**
     * @see RoleTest::testAdmins()
     */
    public function admins(): BelongsToMany
    {
        return $this->belongsToMany(Admin::class, 'role_admin');
    }
}
