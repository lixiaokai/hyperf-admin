<?php

declare (strict_types=1);
namespace Core\Model;

use Carbon\Carbon;
use Hyperf\Database\Model\SoftDeletes;

/**
 * 附件 - 模型.
 *
 * @property int $id 附件 ID
 * @property int $userId 用户 ID
 * @property string $storageMode 存储方式 ( local-本地 oss-阿里云 cos-腾讯云 qiniu-七牛云 )
 * @property string $name 原附件名
 * @property string $type 附件类型
 * @property int $size 附件大小 ( 字节 )
 * @property string $path 附件路径
 * @property string $hash MD5 散列值
 * @property Carbon $createdAt 创建时间
 * @property Carbon $updatedAt 修改时间
 * @property string $deletedAt 删除时间 ( 软删除 )
 */
class Attachment extends BaseModel
{
    use SoftDeletes;

    protected $table = 'attachment';

    protected $fillable = ['id', 'user_id', 'storage_mode', 'name', 'type', 'size', 'path', 'hash', 'created_at', 'updated_at', 'deleted_at'];

    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'size' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
