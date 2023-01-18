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
     * @Text("用户 UID")
     */
    public const UID = 'uid';

    /**
     * @Text("用户模型")
     */
    public const USER = 'user';

    /**
     * @Text("租户模型")
     */
    public const TENANT = 'tenant';
}
