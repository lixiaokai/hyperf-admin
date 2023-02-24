<?php

declare(strict_types=1);

/**
 * 开发者工具 - 配置.
 *
 * @see https://hyperf.wiki/2.2/#/zh-cn/devtool
 */

return [
    'generator' => [
        'amqp' => [
            'consumer' => [
                'namespace' => 'Core\\Amqp\\Consumer',
            ],
            'producer' => [
                'namespace' => 'Core\\Amqp\\Producer',
            ],
        ],
        'aspect' => [
            'namespace' => 'Core\\Aspect',
        ],
        'command' => [
            'namespace' => 'Core\\Command',
        ],
        'controller' => [
            'namespace' => 'App\\Admin\\Controller',
            'stub' => BASE_PATH . '/core/Devtool/Generator/stubs/controller.stub',
        ],
        'job' => [
            'namespace' => 'Core\\Job',
        ],
        'listener' => [
            'namespace' => 'Core\\Listener',
        ],
        'middleware' => [
            'namespace' => 'Core\\Middleware',
        ],
        'Process' => [
            'namespace' => 'Core\\Processes',
        ],
    ],
];
