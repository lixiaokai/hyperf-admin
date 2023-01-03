<?php

declare(strict_types=1);

/**
 * 异常处理器 - 配置.
 *
 * 注意：每个异常处理器配置的顺序决定了异常在处理器间传递的顺序
 */
return [
    'handler' => [
        // 这里的 http 对应 config/autoload/server.php 中 server 所对应的 name 值
        'http' => [
            Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler::class,
            // 验证 - 异常处理器
            Core\Exception\Handler\ValidationExceptionHandler::class,
            // 公共 - 异常处理器 ( 即自定义异常处理器 )
            Core\Exception\Handler\CommonExceptionHandler::class,
            // 托底 - 异常处理器
            Core\Exception\Handler\AppExceptionHandler::class,
        ],
    ],
];
