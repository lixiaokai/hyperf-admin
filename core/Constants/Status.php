<?php

declare(strict_types=1);

namespace Core\Constants;

use Hyperf\Constants\Annotation\Constants;

/**
 * 通用状态 - 常量.
 *
 * @Constants
 *
 * @method static string getColor(string $code)
 * @method static string getText(string $code)
 */
class Status extends BaseConstants
{
    /**
     * 通用状态 - 启用.
     *
     * @Color("green")
     * @Text("启用")
     */
    public const ENABLE = 'enable';

    /**
     * 通用状态 - 禁用.
     *
     * @Color("red")
     * @Text("禁用")
     */
    public const DISABLE = 'disable';
}
