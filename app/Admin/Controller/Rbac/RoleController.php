<?php

declare(strict_types=1);

namespace App\Admin\Controller\Rbac;

use App\Admin\Collection\Rbac\RoleCollection;
use App\Admin\Request\Rbac\RoleMenusRequest;
use App\Admin\Request\Rbac\RoleRequest;
use App\Admin\Resource\Rbac\RoleResource;
use Core\Constants\RoleType;
use Core\Controller\BaseController;
use Core\Response\Response;
use Core\Service\Rbac\RoleService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Psr\Http\Message\ResponseInterface;

/**
 * 角色管理 - 控制器.
 *
 * @Controller(prefix="admin/rbac/role")
 */
class RoleController extends BaseController
{
    /** @Inject */
    protected RoleService $service;

    /**
     * 角色管理 - 列表.
     *
     * 说明：
     * 1. 后台角色 ( 默认 )
     * 2. 租户默认角色 ?type=tenantDefault
     * 2. 租户自定义角色 ?type=tenantCustom
     *
     * @RequestMapping(path="", methods="get")
     */
    public function index(): ResponseInterface
    {
        $type = $this->request->input('type', RoleType::ADMIN);
        $roles = $this->service->list($type);

        return RoleCollection::make($roles);
    }

    /**
     * 角色管理 - 详情.
     *
     * @RequestMapping(path="{id}", methods="get")
     */
    public function show(int $id): ResponseInterface
    {
        $role = $this->service->get($id);

        return RoleResource::make($role);
    }

    /**
     * 角色管理 - 创建 - 基础信息.
     *
     * @RequestMapping(path="", methods="post")
     */
    public function create(RoleRequest $request): ResponseInterface
    {
        $role = $this->service->create($request->validated());

        return Response::success(['id' => $role->id]);
    }

    /**
     * 角色管理 - 修改 - 基础信息.
     *
     * @RequestMapping(path="{id}", methods="put")
     */
    public function update(int $id, RoleRequest $request): ResponseInterface
    {
        $role = $this->service->get($id);
        $this->service->update($role, $request->validated(RoleRequest::SCENE_UPDATE));

        return Response::success();
    }

    /**
     * 角色管理 - 修改 - 权限菜单.
     *
     * @RequestMapping(path="{id}/menus", methods="put")
     */
    public function updateMenus(int $id, RoleMenusRequest $request): ResponseInterface
    {
        $role = $this->service->get($id);
        ['menuIds' => $menuIds] = $request->validated();
        $res = $this->service->updateMenus($role, $menuIds);

        return Response::success($res);
    }

    /**
     * 角色管理 - 启用.
     *
     * @RequestMapping(path="{id}/enable", methods="put")
     */
    public function enable(int $id): ResponseInterface
    {
        $role = $this->service->get($id);
        $this->service->enable($role);

        return Response::success();
    }

    /**
     * 角色管理 - 禁用.
     *
     * @RequestMapping(path="{id}/disable", methods="put")
     */
    public function disable(int $id): ResponseInterface
    {
        $role = $this->service->get($id);
        $this->service->disable($role);

        return Response::success();
    }

    /**
     * 角色管理 - 删除.
     *
     * @RequestMapping(path="{id}", methods="delete")
     */
    public function delete(int $id): ResponseInterface
    {
        $role = $this->service->get($id);
        $this->service->delete($role);

        return Response::success();
    }
}
