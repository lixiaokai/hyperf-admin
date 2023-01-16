<?php

declare(strict_types=1);

namespace Core\Constants;

use Hyperf\Constants\Annotation\Constants;

/**
 * 权限菜单类型 - 常量.
 *
 * @Constants
 * @method static string getText(string $code)
 */
class MenuType extends BaseConstants
{
    /**
     * @Text("菜单")
     */
    public const MENU = 'menu';

    /**
     * @Text("按钮")
     */
    public const BUTTON = 'button';
}
