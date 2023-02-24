<?php

declare(strict_types=1);

namespace App\Admin\Controller\Rbac;

use App\Admin\Collection\Rbac\AdminCollection;
use App\Admin\Middleware\AuthMiddleware;
use App\Admin\Middleware\PermissionMiddleware;
use App\Admin\Request\Rbac\AdminRequest;
use App\Admin\Resource\Rbac\AdminResource;
use Core\Controller\BaseController;
use Core\Request\SearchRequest;
use Core\Response\Response;
use Core\Service\Rbac\AdminService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\Middlewares;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Psr\Http\Message\ResponseInterface;

/**
 * 用户管理 - 控制器.
 *
 * @Controller(prefix="admin/rbac/admin")
 * @Middlewares({
 *     @Middleware(AuthMiddleware::class),
 *     @Middleware(PermissionMiddleware::class)
 * })
 */
class AdminController extends BaseController
{
    /** @Inject */
    protected AdminService $service;

    /**
     * 用户管理 - 列表.
     *
     * @RequestMapping(path="", methods="get")
     */
    public function index(SearchRequest $request): ResponseInterface
    {
        $res = $this->service->search($request->searchParams());

        return AdminCollection::make($res);
    }

    /**
     * 用户管理 - 详情.
     *
     * @RequestMapping(path="{id}", methods="get")
     */
    public function show(int $id): ResponseInterface
    {
        $admin = $this->service->get($id);

        return AdminResource::make($admin);
    }

    /**
     * 用户管理 - 创建.
     *
     * @RequestMapping(path="", methods="post")
     */
    public function create(AdminRequest $request): ResponseInterface
    {
        $admin = $this->service->create($request->validated());

        return Response::success(['id' => $admin->id]);
    }

    /**
     * 用户管理 - 修改.
     *
     * @RequestMapping(path="{id}", methods="put")
     */
    public function update(int $id, AdminRequest $request): ResponseInterface
    {
        $admin = $this->service->get($id);
        $this->service->update($admin, $request->validated());

        return Response::success();
    }

    /**
     * 用户管理 - 启用.
     *
     * @RequestMapping(path="{id}/enable", methods="put")
     */
    public function enable(int $id): ResponseInterface
    {
        $admin = $this->service->get($id);
        $this->service->enable($admin);

        return Response::success();
    }

    /**
     * 用户管理 - 禁用.
     *
     * @RequestMapping(path="{id}/disable", methods="put")
     */
    public function disable(int $id): ResponseInterface
    {
        $admin = $this->service->get($id);
        $this->service->disable($admin);

        return Response::success();
    }
}
