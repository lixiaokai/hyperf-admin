<?php

declare(strict_types=1);

namespace Core\Model;

use Carbon\Carbon;
use Core\Model\Traits\StatusTrait;
use Core\Model\Traits\UserActionTrail;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Relations\BelongsToMany;
use Hyperf\Database\Model\Relations\HasOne;
use HyperfTest\Model\UserTest;

/**
 * 基础用户 - 模型.
 *
 * 说明：即所有用户的基础表
 *
 * @property int         $id        用户 ID
 * @property null|string $name      用户名
 * @property string      $phone     手机号
 * @property null|string $password  密码
 * @property string      $status    状态 ( enable-启用 disable-禁用 )
 * @property Carbon      $createdAt 创建时间
 * @property Carbon      $updatedAt 修改时间
 *
 * @property Admin               $admin   总后台用户
 * @property Collection|Role[]   $roles   角色 ( 多条 )
 * @property Collection|Tenant[] $tenants 租户 ( 多条 )
 *
 * @see UserTest::class
 */
class User extends BaseModel
{
    use StatusTrait;
    use UserActionTrail;

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

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @see UserTest::testAdmin()
     */
    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class, 'id');
    }

    /**
     * @see UserTest::testRoles()
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    /**
     * @see UserTest::testTenants()
     */
    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class);
    }
}
