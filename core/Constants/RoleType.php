<?php

declare(strict_types=1);

namespace Core\Constants;

use Hyperf\Constants\Annotation\Constants;

/**
 * 角色类型 - 常量.
 *
 * @Constants
 * @method static getText(string $code)
 */
class RoleType extends BaseConstants
{
    /**
     * @Text("总后台角色")
     */
    public const ADMIN = 'admin';

    /**
     * @Text("租户默认角色")
     */
    public const TENANT_DEFAULT = 'tenantDefault';

    /**
     * @Text("租户自定义角色")
     */
    public const TENANT_CUSTOM = 'tenantCustom';
}
