<?php

declare(strict_types=1);

namespace Kernel\Constants;

use Hyperf\Constants\Annotation\Constants;

/**
 * 错误代码 - 枚举类.
 *
 * @Constants
 */
class ErrorCode extends BaseConstants
{
    /**
     * @Message("Server Error！")
     */
    public const SERVER_ERROR = 500;
}