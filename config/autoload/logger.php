<?php

declare(strict_types=1);

use Core\Monolog\Handler\StreamHandler;
use Monolog\Formatter\JsonFormatter;
use Monolog\Logger;

/**
 * 日志 - 配置文件.
 *
 * @see https://hyperf.wiki/2.2/#/zh-cn/logger
 */

$appEnv = env('APP_ENV', 'dev');

return [
    'default' => [
        'handlers' => [
            // debug 日志
            [
                'class' => StreamHandler::class,
                'constructor' => [
                    'stream' => $appEnv === 'dev' ? 'php://stdout' : BASE_PATH . '/runtime/logs/hyperf-debug.log',
                    'level' => Logger::DEBUG,
                ],
                'formatter' => [
                    'class' => JsonFormatter::class,
                ],
            ],
            // info、waring、notice 日志
            [
                'class' => StreamHandler::class,
                'constructor' => [
                    'stream' => $appEnv === 'dev' ? 'php://stdout' : BASE_PATH . '/runtime/logs/hyperf.log',
                    'level' => Logger::INFO,
                ],
                'formatter' => [
                    'class' => JsonFormatter::class,
                ],
            ],
            // error 日志
            [
                'class' => StreamHandler::class,
                'constructor' => [
                    'stream' => $appEnv === 'dev' ? 'php://stdout' : BASE_PATH . '/runtime/logs/hyperf-error.log',
                    'level' => Logger::ERROR,
                ],
                'formatter' => [
                    'class' => JsonFormatter::class,
                ],
            ],
        ],
    ],
];
