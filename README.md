# 项目介绍

基于 Hyperf 框架的骨架基础库应用程序

# Requirements

Hyperf 对系统环境有一定的要求，它只能在 Linux 和 Mac 环境下运行，但由于 Docker 虚拟化技术的发展，Docker for Windows 也可以作为 Windows 下的运行环境。

Dockerfile 的各个版本： [hyperf/hyperf-docker](https://github.com/hyperf/hyperf-docker)，或直接基于已经构建的 [hyperf/hyperf](https://hub.docker.com/r/hyperf/hyperf) Image 运行。

当你不想使用 Docker 作为运行环境的基础时，你需要确保你的操作环境满足以下要求:

 - PHP >= 7.4 and <= 8.0
 - ext-swoole >= 4.5 ( php.ini swoole.use_shortname=Off 配置为关闭 )
 - ext-json
 - ext-pcntl
 - ext-openssl ( 如需要使用到 HTTPS )
 - ext-pdo ( 如需要使用到 MySQL 客户端 )
 - ext-redis ( 如需要使用到 Redis 客户端 )
 - ext-protobuf ( 如需要使用到 gRPC 服务端或客户端 )

# 安装或更新依赖

首次执行，如下 2 选 1 命令即可，以后如果需要更新依赖则执行更新命令即可

```bash
# 安装依赖 ( 也可以运行 composer update -o 更新依赖来安装 )
composer install

# 更新依赖 ( 注意：后面要加上 -o，这样 vender 更新时才会自动加载 )
composer update -o
```
# 常用命令

## 运行项目

```bash
# 开发环境 ( 热更新模式 )
composer dev

# 生产环境
composer start

# kill 进程
composer kill
```
这将在端口 `9501` 上启动 `cli-server`，并将其绑定到所有网络接口。

您可以通过该域名访问 http://localhost:9501 Hyperf 默认主页。

## 发布配置
```
# 发布 Redis 消息异步队列配置 ( 如果要发布其他组件的配置，直接修改最后的组件名即可 )
php bin/hyperf.php vendor:publish hyperf/async-queue
```

## 异步队列 - 创建消费任务

```bash
# 后面的名称首字母建议用大写，因为是创建同名文件
php bin/hyperf.php gen:job DemoJob
```

# PhpStorm 推荐配置

## 1. runtime 目录设为排除目录
在左侧项目目录中选择 runtime 文件 > 鼠标右键 > Mark Directory as > Excluded

## 2. .php-cs-fixer.php 配置

设置中搜索 `php-cs-fixer`，并配置上，使得团队代码风格统一，且支持简单的质量检查

## 3. 推荐安装插件 ( Plugins )

- .env files support
- PHP Annotations

# 目录

# 说明

- app - 通用目录
- common - 公共资源目录
- demo - 示例目录

## 注意：根目录增加文件夹时需要修改的地方

### 1. composer.json 增加自动加载目录 ( autoload )
```json
{
  "autoload": {
    "psr-4": {
      "App\\": "app/",
      "Common\\": "common/",
      "Demo\\": "demo/"
    },
    "files": []
  }
}
```

### 2. config/autoload/watcher.php 增加热更新目录
```php
return [
    'driver' => ScanFileDriver::class,
    'bin' => 'php',
    'watch' => [
        'dir' => ['app', 'config', 'common', 'demo'],
        'file' => ['.env'],
        'scan_interval' => 2000,
    ],
];
```

### 3. config/autoload/annotations.php 增加注解扫描目录
```php
return [
    'scan' => [
        // 注解扫描的目录
        'paths' => [
            BASE_PATH . '/app',
            BASE_PATH . '/common',
            BASE_PATH . '/demo',
        ],
        // 忽略的注解名
        'ignore_annotations' => [
            'mixin',
        ],
    ],
];
```
