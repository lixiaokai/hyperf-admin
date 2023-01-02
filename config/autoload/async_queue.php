<?php

declare(strict_types=1);

/**
 * Redis 消息异步队列 - 配置文件.
 *
 * @see https://hyperf.wiki/2.2/#/zh-cn/async-queue
 */

return [
    'default' => [
        'driver' => Hyperf\AsyncQueue\Driver\RedisDriver::class,
        'redis' => [
            'pool' => 'default', // redis 连接池
        ],
        'channel' => '{queue}',  // 队列前缀
        'timeout' => 2,          // pop 消息的超时时间
        'retry_seconds' => 5,    // 失败后重新尝试间隔 ( 秒 ) ，也可传入数组，根据重试次数相应修改重试时间，例如 [1, 5, 10, 20]
        'handle_timeout' => 10,  // 消息处理超时时间 ( 秒 )
        'processes' => 1,        // 消费进程数
        'concurrent' => [
            'limit' => 10,       // 同时处理消息数
        ],
        'max_messages' => 0,     // 进程重启所需最大处理的消息数 ( 默认 0-不重启 )
    ],
];
