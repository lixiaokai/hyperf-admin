<?php

declare(strict_types=1);

namespace Core\Constants;

use Hyperf\Constants\Annotation\Constants;

/**
 * 请求方式 - 常量.
 *
 * @Constants
 * @method static string getText(string $code)
 */
class RequestMethod extends BaseConstants
{
    /**
     * @Text("获取")
     */
    public const GET = 'GET';

    /**
     * @Text("创建")
     */
    public const POST = 'POST';

    /**
     * @Text("修改")
     */
    public const PUT = 'PUT';

    /**
     * @Text("删除")
     */
    public const DELETE = 'DELETE';
}
