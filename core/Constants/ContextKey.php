<?php

namespace Core\Constants;

use Hyperf\Constants\Annotation\Constants;

/**
 * 上下文 Key - 常量.
 *
 * @Constants
 * @method static string getText(string $code)
 */
class ContextKey extends BaseConstants
{
    /**
     * 用户 UID.
     */
    public const UID = 'uid';

    /**
     * 用户模型.
     */
    public const USER = 'user';

    /**
     * 总后台用户模型.
     */
    public const ADMIN = 'admin';

    /**
     * 租户模型.
     */
    public const TENANT = 'tenant';
}
