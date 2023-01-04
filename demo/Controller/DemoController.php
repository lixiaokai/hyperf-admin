<?php

declare(strict_types=1);

namespace Demo\Controller;

use Demo\Collection\DemoCollection;
use Demo\Request\DemoRequest;
use Demo\Resource\DemoResource;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Kernel\Controller\BaseController;
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
     * 演示 - 列表.
     *
     * @RequestMapping(path="", methods="get")
     */
    public function list(): ResponseInterface
    {
        return DemoCollection::make([
            ['id' => 1, 'name' => '名称 1', 'remark' => '备注 1'],
            ['id' => 2, 'name' => '名称 2', 'remark' => '备注 2'],
        ]);
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
