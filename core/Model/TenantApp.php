<?php

declare(strict_types=1);

namespace Core\Model;

use Carbon\Carbon;

/**
 * 租户应用关系 - 模型.
 *
 * @property int    $id        自增 ID
 * @property int    $tenantId  租户 ID
 * @property int    $appId     应用 ID
 * @property Carbon $createdAt 创建时间
 */
class TenantApp extends BaseModel
{
    public const UPDATED_AT = null;

    protected $table = 'tenant_app';

    protected $fillable = ['id', 'tenant_id', 'app_id', 'created_at'];

    protected $casts = ['id' => 'integer', 'tenant_id' => 'integer', 'app_id' => 'integer', 'created_at' => 'datetime'];
}
