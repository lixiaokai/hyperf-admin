<?php

declare(strict_types=1);

namespace App\Admin\Middleware;

use Core\Service\Rbac\AdminPermissionService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Router\Dispatched;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * 总后台权限 - 中间件.
 */
class PermissionMiddleware implements MiddlewareInterface
{
    protected ContainerInterface $container;

    /** @Inject */
    protected AdminPermissionService $permissionService;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // 权限检查
        /** @var Dispatched $dispatched */
        // $request->getUri()->getPath() 例：/admin/user/1
        $dispatched = $request->getAttribute(Dispatched::class);
        $route = $dispatched->handler->route; // 当前访问路由 例如：/admin/user/{id:\d+}
        $this->permissionService->check($request->getMethod(), $route);

        return $handler->handle($request);
    }
}
