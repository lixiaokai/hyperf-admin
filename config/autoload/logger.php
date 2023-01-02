<?php

declare(strict_types=1);

/**
 * 日志 - 配置文件.
 *
 * @see https://hyperf.wiki/2.2/#/zh-cn/logger
 */

$appEnv = env('APP_ENV', 'dev');

return [
    'default' => [
        'handlers' => [
            // info、waring、notice 日志
            [
                'class' => Monolog\Handler\StreamHandler::class,
                'constructor' => [
                    'stream' => $appEnv === 'dev' ? 'php://stdout' : BASE_PATH . '/runtime/logs/hyperf.log',
                    'level' => Monolog\Logger::INFO,
                ],
                'formatter' => [
                    'class' => Monolog\Formatter\JsonFormatter::class,
                ],
            ],
            // error 日志
            [
                'class' => Monolog\Handler\StreamHandler::class,
                'constructor' => [
                    'stream' => $appEnv === 'dev' ? 'php://stdout' : BASE_PATH . '/runtime/logs/hyperf-error.log',
                    'level' => Monolog\Logger::ERROR,
                ],
                'formatter' => [
                    'class' => Monolog\Formatter\JsonFormatter::class,
                ],
            ],
        ],
    ],
];
