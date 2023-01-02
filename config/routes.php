<?php

declare(strict_types=1);

/**
 * 路由 - 配置文件.
 *
 * 说明：使用注解的方式注册路由，该配置忽略即可.
 * @see https://hyperf.wiki/2.2/#/zh-cn/router
 */

use Hyperf\HttpServer\Router\Router;

// 只保留网站 icon 图标的 get 请求
Router::get('/favicon.ico', function () {
    return '';
});
