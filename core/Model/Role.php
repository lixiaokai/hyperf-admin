<?php

declare(strict_types=1);

namespace Core\Model;

use Carbon\Carbon;
use Core\Constants\RoleType;
use Core\Model\Traits\RoleActionTrail;
use Core\Model\Traits\StatusTrait;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Relations\BelongsTo;
use Hyperf\Database\Model\Relations\BelongsToMany;
use Hyperf\Database\Model\Relations\HasMany;

/**
 * 角色 - 模型.
 *
 * @property int    $id        角色 ID
 * @property int    $parentId  父 ID ( 租户角色才有上下级 )
 * @property string $type      类型 ( admin-总后台角色 tenantDefault-租户默认角色 tenantCustom-租户自定义角色 )
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
 * @property Role                $parent   父级角色
 * @property Collection|Role[]   $children 子级角色 ( 多条 )
 * @property Collection|Role[]   $siblings 同级角色 ( 多条 )
 * @property Collection|Menu[]   $menus    菜单 ( 多条 )
 * @property Collection|Tenant[] $tenants  租户 ( 多条 )
 * @property Collection|User[]   $users    用户 ( 多条 )
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
        'type',
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

    public function getTypeTextAttribute(): string
    {
        return RoleType::getText($this->type);
    }

    public function getPlatformKeyAttribute(): string
    {
        return RoleType::getPlatformKey($this->type);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function siblings(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'parent_id');
    }

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'role_menu');
    }

    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
