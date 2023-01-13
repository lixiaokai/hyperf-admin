<?php

declare(strict_types=1);

namespace App\Tenant\Controller;

use App\Tenant\Middleware\AuthMiddleware;
use App\Tenant\Middleware\PermissionMiddleware;
use Core\Controller\BaseController;
use Core\Response\Response;
use Core\Service\Rbac\MenuService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\Middlewares;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Psr\Http\Message\ResponseInterface;

/**
 * 权限菜单 - 控制器.
 *
 * @Controller(prefix="tenant/menu")
 * @Middlewares({
 *     @Middleware(AuthMiddleware::class),
 *     @Middleware(PermissionMiddleware::class)
 * })
 */
class MenuController extends BaseController
{
    /** @Inject */
    protected MenuService $service;

    /**
     * 权限菜单 - 列表.
     *
     * @RequestMapping(path="", methods="get")
     */
    public function index(): ResponseInterface
    {
        $menuTree = $this->service->getUserTrees();

        return Response::withData($menuTree);
    }
}
