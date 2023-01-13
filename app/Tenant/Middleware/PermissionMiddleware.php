<?php

declare(strict_types=1);

namespace App\Tenant\Middleware;

use Core\Service\Rbac\PermissionService;
use Hyperf\Di\Annotation\Inject;
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
    /** @Inject */
    protected PermissionService $permissionService;

    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->permissionService->check($request->getMethod(), $request->getUri()->getPath());

        return $handler->handle($request);
    }
}
