<?php

declare(strict_types=1);

namespace Core\Constants;

use Hyperf\Constants\Annotation\Constants;

/**
 * 终端平台 - 常量.
 *
 * @Constants
 * @method static getText(string $code)
 */
class Platform extends BaseConstants
{
    /**
     * @Text("总后台")
     */
    public const ADMIN = 'admin';

    /**
     * @Text("租户后台")
     */
    public const TENANT = 'tenant';
}
