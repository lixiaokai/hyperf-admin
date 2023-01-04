<?php

declare(strict_types=1);

/**
 * 定时任务 - 配置.
 *
 * rule 参数:
 * 1. 6 位参数: 秒 分 时 天 月 星期.
 * 2. 5 位参数:    分 时 天 月 星期.
 *
 * @see https://hyperf.wiki/2.2/#/zh-cn/crontab
 */

return [
    'enable' => false,
    'crontab' => [
    ],
];
