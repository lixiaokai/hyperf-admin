<?php

declare(strict_types=1);

/**
 * 注解 - 配置文件.
 */

return [
    'scan' => [
        // 注解扫描的目录
        'paths' => [
            BASE_PATH . '/app',
            BASE_PATH . '/common',
            BASE_PATH . '/core',
            BASE_PATH . '/demo',
        ],
        // 忽略的注解名
        'ignore_annotations' => [
            'mixin',
        ],
    ],
];
