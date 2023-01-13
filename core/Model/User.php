<?php

declare(strict_types=1);

namespace Core\Model;

use Core\Constants\Status;
use Core\Model\Traits\StatusTrait;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Relations\BelongsToMany;
use Hyperf\Utils\Collection as UCollection;
use HyperfTest\Model\UserTest;

/**
 * 用户信息 - 模型.
 *
 * @property int    $id        用户 ID
 * @property string $name      用户名
 * @property string $phone     手机号
 * @property string $password  密码
 * @property string $status    状态 ( enable-启用 disable-禁用 )
 * @property string $createdAt 创建时间
 * @property string $updatedAt 修改时间
 *
 * @property Collection|Role[]   $roles   角色 ( 多条 )
 * @property Collection|Tenant[] $tenants 租户 ( 多条 )
 *
 * @see UserTest::class
 */
class User extends BaseModel
{
    use StatusTrait;

    protected $table = 'user';

    protected $fillable = [
        'id',
        'name',
        'phone',
        'password',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * 获取 - 用户所有菜单.
     *
     * @see UserTest::testAllMenus()
     * @return Menu[]|UCollection
     */
    public function allMenus(): UCollection
    {
        return $this->roles()
            ->with(['menus' => function (BelongsToMany $query) {
                $query->where(Menu::column('status'), Status::ENABLE);
            }])
            ->get()
            ->pluck('menus')
            ->flatten()
            ->unique('id');
    }

    /**
     * @see UserTest::testRoles()
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @see UserTest::testTenants()
     */
    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class);
    }
}
