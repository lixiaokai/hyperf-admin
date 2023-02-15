<?php

declare(strict_types=1);

namespace App\Tenant\Middleware;

use Hyperf\HttpServer\Router\Dispatched;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * 权限 - 中间件.
 */
class PermissionMiddleware implements MiddlewareInterface
{
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var Dispatched $dispatched */
        $dispatched = $request->getAttribute(Dispatched::class);
        $route = $dispatched->handler->route; // 当前访问路由 例如：/admin/user/{id:\d+}

        // $this->permissionService->check($request->getMethod(), $request->getUri()->getPath());

        return $handler->handle($request);
    }
}
