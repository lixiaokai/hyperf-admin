<?php

declare(strict_types=1);

namespace Core\Model\Admin;

use Carbon\Carbon;
use Core\Constants\MenuType;
use Core\Constants\Platform;
use Core\Model\BaseModel;
use Core\Model\Traits\MenuActionTrail;
use Core\Model\Traits\StatusTrait;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Relations\BelongsTo;
use Hyperf\Database\Model\Relations\BelongsToMany;
use Hyperf\Database\Model\Relations\HasMany;

/**
 * 权限菜单 - 模型.
 *
 * @property int    $id        权限菜单 ID
 * @property int    $parentId  父 ID
 * @property string $platform  终端平台 ( admin-总后台 tenant-租户后台 )
 * @property int    $appId     应用 ID
 * @property string $method    请求方式 ( GET POST PUT DELETE )
 * @property string $path      前端路由
 * @property string $uri       路由 uri
 * @property string $name      名称
 * @property string $remark    备注
 * @property string $icon      图标
 * @property string $type      类型 ( menu-菜单 button-按钮 )
 * @property string $status    状态 ( enable-启用 disabled-禁用 )
 * @property int    $sort      排序
 * @property Carbon $createdAt 创建时间
 * @property Carbon $updatedAt 修改时间
 *
 * @property string $platformText 终端平台 - 文字
 * @property string $typeText     类型 - 文字
 *
 * @property Menu              $parent   父级菜单
 * @property Collection|Menu[] $children 子级菜单 ( 多条 )
 * @property Collection|Menu[] $siblings 同级菜单 ( 多条 )
 * @property Collection|Role[] $roles    角色 ( 多条 )
 */
class Menu extends BaseModel
{
    use StatusTrait;
    use MenuActionTrail;

    protected $table = 'menu';

    protected $fillable = [
        'id',
        'parent_id',
        'platform',
        'app_id',
        'method',
        'path',
        'uri',
        'name',
        'remark',
        'icon',
        'type',
        'status',
        'sort',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'app_id' => 'integer',
        'sort' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getPlatformTextAttribute(): string
    {
        return Platform::getText($this->platform);
    }

    public function getTypeTextAttribute(): string
    {
        return MenuType::getText($this->type);
    }

    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class);
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

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
