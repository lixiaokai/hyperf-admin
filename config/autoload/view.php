<?php

declare(strict_types=1);

/**
 * 视图 - 配置文件.
 *
 * @see https://hyperf.wiki/3.0/#/zh-cn/view
 */

use Hyperf\View\Mode;

return [
    // 使用的渲染引擎
    'engine' => Hyperf\ViewEngine\HyperfViewEngine::class,

    // 不填写则默认为 Task 模式，推荐使用 Task 模式
    'mode' => Mode::SYNC,

    // 若下列文件夹不存在请自行创建
    'config' => [
        'view_path' => BASE_PATH . '/storage/view/',
        'cache_path' => BASE_PATH . '/runtime/view/',
    ],

    // 自定义组件注册
    'components' => [
        // 'alert' => \App\View\Components\Alert::class
    ],

    // 视图命名空间 (主要用于扩展包中)
    'namespaces' => [
        // 'admin' => BASE_PATH . '/storage/view/vendor/admin',
    ],
];
