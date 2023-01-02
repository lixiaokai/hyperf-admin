<?php

declare(strict_types=1);

use Hyperf\HttpServer\Router\Router;

// 只保留网站 icon 图标的 get 请求
Router::get('/favicon.ico', function () {
    return '';
});
