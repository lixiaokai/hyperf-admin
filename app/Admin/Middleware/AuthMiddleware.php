<?php

declare(strict_types=1);

namespace App\Admin\Middleware;

use Core\Constants\ContextKey;
use Core\Service\Rbac\AdminService;
use Hyperf\Context\Context;
use Hyperf\Di\Annotation\Inject;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * 总后台认证 - 中间件.
 */
class AuthMiddleware implements MiddlewareInterface
{
    protected ContainerInterface $container;

    /** @Inject */
    protected AdminService $adminService;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $uid = 1; // Todo: 临时写死
        $this->setUser($uid);

        return $handler->handle($request);
    }

    protected function setUser(int $uid)
    {
        $admin = $this->adminService->get($uid);

        Context::set(ContextKey::UID, $uid);
        Context::set(ContextKey::ADMIN, $admin);
        Context::set(ContextKey::USER, $admin->user);
    }
}
