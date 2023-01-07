<?php

declare(strict_types=1);

namespace Core\Model;

use Carbon\Carbon;
use Core\Model\ActionTraits\AppActionTrail;
use Core\Model\Traits\StatusTrait;
use Hyperf\Database\Model\SoftDeletes;

/**
 * 应用 - 模型.
 *
 * 说明：租用应用
 *
 * @property int    $id        自增 ID
 * @property string $key       应用 Key
 * @property string $name      应用名称
 * @property int    $sort      排序
 * @property string $status    状态 ( enable-启用 disable-禁用 )
 * @property Carbon $createdAt 创建时间
 * @property Carbon $updatedAt 修改时间
 * @property Carbon $deletedAt 删除时间
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
}
