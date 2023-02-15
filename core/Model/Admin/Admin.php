<?php

declare(strict_types=1);

namespace Core\Model\Admin;

use Carbon\Carbon;
use Core\Model\BaseModel;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Relations\BelongsToMany;

/**
 * 总后台用户 - 模型.
 *
 * @property int    $id        AdminID
 * @property string $name      用户名
 * @property string $phone     手机号
 * @property string $password  密码
 * @property string $status    状态 ( enable-启用 disable-禁用 )
 * @property Carbon $createdAt 创建时间
 * @property Carbon $updatedAt 修改时间
 *
 * @property Collection|Role[] $roles 角色 ( 多条 )
 */
class Admin extends BaseModel
{
    protected $table = 'admin';

    protected $fillable = ['id', 'name', 'phone', 'password', 'status', 'created_at', 'updated_at'];

    protected $casts = ['id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    /**
     * @see AdminTest::testRoles()
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_admin');
    }
}
