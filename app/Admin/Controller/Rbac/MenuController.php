<?php

declare(strict_types=1);

namespace App\Admin\Controller\Rbac;

use App\Admin\Request\MenuRequest;
use App\Admin\Resource\MenuResource;
use Core\Controller\BaseController;
use Core\Response\Response;
use Core\Service\Rbac\MenuService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Psr\Http\Message\ResponseInterface;

/**
 * 菜单管理 - 控制器.
 *
 * @Controller(prefix="admin/rbac/menu")
 */
class MenuController extends BaseController
{
    /** @Inject */
    protected MenuService $service;

    /**
     * 菜单管理 - 列表.
     *
     * 说明：
     * 1. 后台菜单 ( 默认 )
     * 2. 租户菜单 ?platform=tenant
     *
     * @RequestMapping(path="", methods="get")
     */
    public function index(): ResponseInterface
    {
        $platform = $this->request->input('platform');
        $menus = $this->service->getTrees($platform);

        return Response::withData($menus);
    }

    /**
     * 菜单管理 - 详情.
     *
     * @RequestMapping(path="{id}", methods="get")
     */
    public function show(int $id): ResponseInterface
    {
        $menu = $this->service->get($id);

        return MenuResource::make($menu);
    }

    /**
     * 菜单管理 - 创建.
     *
     * @RequestMapping(path="", methods="post")
     */
    public function create(MenuRequest $request): ResponseInterface
    {
        $menu = $this->service->create($request->validated());

        return Response::success(['id' => $menu->id]);
    }

    /**
     * 菜单管理 - 修改.
     *
     * @RequestMapping(path="{id}", methods="put")
     */
    public function update(int $id, MenuRequest $request): ResponseInterface
    {
        $menu = $this->service->get($id);
        $this->service->update($menu, $request->validated(MenuRequest::SCENE_UPDATE));

        return Response::success();
    }

    /**
     * 菜单管理 - 启用.
     *
     * @RequestMapping(path="{id}/enable", methods="put")
     */
    public function enable(int $id): ResponseInterface
    {
        $menu = $this->service->get($id);
        $this->service->enable($menu);

        return Response::success();
    }

    /**
     * 菜单管理 - 禁用.
     *
     * @RequestMapping(path="{id}/disable", methods="put")
     */
    public function disable(int $id): ResponseInterface
    {
        $menu = $this->service->get($id);
        $this->service->disable($menu);

        return Response::success();
    }

    /**
     * 菜单管理 - 删除.
     *
     * @RequestMapping(path="{id}", methods="delete")
     */
    public function delete(int $id): ResponseInterface
    {
        $menu = $this->service->get($id);
        $this->service->delete($menu);

        return Response::success();
    }
}
