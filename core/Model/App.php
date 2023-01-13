<?php

declare(strict_types=1);

namespace Core\Model;

use Carbon\Carbon;
use Core\Model\Traits\AppActionTrail;
use Core\Model\Traits\StatusTrait;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Relations\BelongsToMany;
use Hyperf\Database\Model\Relations\HasMany;
use Hyperf\Database\Model\SoftDeletes;

/**
 * 租户应用 - 模型.
 *
 * 说明：租用应用 ( 以后是否会加入别的应用再根据业务调整 )
 *
 * @property int    $id        应用 ID
 * @property string $key       应用 Key
 * @property string $name      应用名称
 * @property int    $sort      排序
 * @property string $status    状态 ( enable-启用 disable-禁用 )
 * @property Carbon $createdAt 创建时间
 * @property Carbon $updatedAt 修改时间
 * @property Carbon $deletedAt 删除时间
 *
 * @property Collection|Tenant[] $tenants 租户 ( 多条 )
 * @property Collection|Menu[]   $menus   菜单 ( 多条 )
 */
class App extends BaseModel
{
    use SoftDeletes;
    use StatusTrait;
    use AppActionTrail;

    protected $table = 'app';

    protected $fillable = [
        'id',
        'key',
        'name',
        'sort',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'sort' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class);
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
