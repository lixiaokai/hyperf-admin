<?php

declare(strict_types=1);

namespace App\Admin\Controller;

use App\Admin\Collection\AppCollection;
use App\Admin\Request\AppRequest;
use App\Admin\Resource\AppResource;
use Core\Controller\BaseController;
use Core\Response\Response;
use Core\Service\AppService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Kernel\Annotation\Permission\AdditionalPermissions;
use Psr\Http\Message\ResponseInterface;

/**
 * 应用 - 控制器.
 *
 * @Controller(prefix="admin/app")
 */
class AppController extends BaseController
{
    /** @Inject */
    protected AppService $service;

    /**
     * 应用 - 列表.
     *
     * @RequestMapping(path="", methods="get")
     */
    public function index(): ResponseInterface
    {
        $apps = $this->service->list();

        return AppCollection::make($apps);
    }

    /**
     * 应用 - 详情.
     *
     * 说明：附加列表权限
     *
     * @AdditionalPermissions(routes={"admin/app"})
     * @RequestMapping(path="{id}", methods="get")
     */
    public function show(int $id): ResponseInterface
    {
        $app = $this->service->get($id);

        return AppResource::make($app);
    }

    /**
     * 应用 - 创建.
     *
     * @RequestMapping(path="", methods="post")
     */
    public function create(AppRequest $request): ResponseInterface
    {
        $app = $this->service->create($request->validated());

        return Response::success(['id' => $app->id]);
    }

    /**
     * 应用 - 修改.
     *
     * @RequestMapping(path="{id}", methods="put")
     */
    public function update(int $id, AppRequest $request): ResponseInterface
    {
        $app = $this->service->get($id);
        $this->service->update($app, $request->validated(AppRequest::SCENE_UPDATE));

        return Response::success();
    }

    /**
     * 应用 - 启用.
     *
     * @RequestMapping(path="{id}/enable", methods="put")
     */
    public function enable(int $id): ResponseInterface
    {
        $app = $this->service->get($id);
        $this->service->enable($app);

        return Response::success();
    }

    /**
     * 应用 - 禁用.
     *
     * @RequestMapping(path="{id}/disable", methods="put")
     */
    public function disable(int $id): ResponseInterface
    {
        $app = $this->service->get($id);
        $this->service->disable($app);

        return Response::success();
    }

    /**
     * 应用 - 删除.
     *
     * @RequestMapping(path="{id}", methods="delete")
     */
    public function delete(int $id): ResponseInterface
    {
        $app = $this->service->get($id);
        $this->service->delete($app);

        return Response::success();
    }
}
