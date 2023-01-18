<?php

declare(strict_types=1);

namespace Core\Model;

use Carbon\Carbon;
use Core\Model\Traits\StatusTrait;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Relations\BelongsToMany;

/**
 * 租户 - 模型.
 *
 * @property int    $id        租户 ID
 * @property string $name      名称 ( 公司名称 )
 * @property string $data      数据 ( json )
 * @property string $status    状态 ( enable-启用 disable-禁用 )
 * @property Carbon $createdAt 创建时间
 * @property Carbon $updatedAt 修改时间
 *
 * @property App[]|Collection  $apps  应用 ( 多条 )
 * @property Collection|Role[] $roles 角色 ( 多条 )
 * @property Collection|User[] $users 用户 ( 多条 )
 */
class Tenant extends BaseModel
{
    use StatusTrait;

    protected $table = 'tenant';

    protected $fillable = [
        'id',
        'name',
        'data',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function apps(): BelongsToMany
    {
        return $this->belongsToMany(App::class, 'tenant_app');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
