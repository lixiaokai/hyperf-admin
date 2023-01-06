<?php

declare(strict_types=1);

namespace Core\Model;

/**
 * 用户信息 - 模型.
 *
 * @property int    $id     自增 ID
 * @property string $name   名称
 * @property string $phone  手机号
 * @property string $status 状态 ( enable-启用 disable-禁用 )
 */
class User extends BaseModel
{
    public $timestamps = false;

    protected $table = 'user';

    protected $fillable = ['id', 'name', 'phone', 'status'];

    protected $casts = ['id' => 'integer'];
}
