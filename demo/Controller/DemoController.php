<?php

declare(strict_types=1);

namespace Demo\Controller;

use Demo\Collection\DemoCollection;
use Demo\Request\DemoRequest;
use Demo\Resource\DemoResource;
use Demo\Service\DemoService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Kernel\Controller\BaseController;
use Kernel\Request\SearchRequest;
use Kernel\Response\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * 演示首页 - 控制器.
 *
 * @Controller(prefix="demo")
 */
class DemoController extends BaseController
{
    /**
     * @Inject
     */
    protected DemoService $service;

    /**
     * 演示 - 列表.
     *
     * @RequestMapping(path="", methods="get")
     */
    public function list(SearchRequest $request): ResponseInterface
    {
        $res = $this->service->search($request->searchParams());
        return DemoCollection::make($res);
    }

    /**
     * 演示 - 详情.
     *
     * @RequestMapping(path="{id:\d+}", methods="get")
     */
    public function detail(int $id): ResponseInterface
    {
        return DemoResource::make(['id' => 1, 'name' => '名称 1', 'remark' => '备注 1']);
    }

    /**
     * 演示 - 创建.
     *
     * @RequestMapping(path="", methods="post")
     */
    public function create(DemoRequest $request): ResponseInterface
    {
        $res = $request->validated(DemoRequest::SCENE_CREATE);
        return Response::success($res);
    }

    /**
     * 演示 - 修改.
     *
     * @RequestMapping(path="{id:\d+}", methods="put")
     */
    public function update(DemoRequest $request, int $id): ResponseInterface
    {
        $res = ['id' => $id] + $request->validated();
        return Response::success($res);
    }
}
