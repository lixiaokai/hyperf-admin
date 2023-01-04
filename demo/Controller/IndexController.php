<?php

declare(strict_types=1);

namespace Demo\Controller;

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
class IndexController extends BaseController
{
    /**
     * 演示 - 列表.
     *
     * @RequestMapping(path="", methods="get")
     */
    public function list(): ResponseInterface
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return Response::withData([
            'method' => $method,
            'message' => "Hello {$user}.",
        ]);
    }

    /**
     * 演示 - 详情.
     *
     * @RequestMapping(path="{id:\d+}", methods="get")
     */
    public function detail(int $id): ResponseInterface
    {
        return Response::withData([
            'method' => $this->request->getMethod(),
            'data' => [
                'id' => $id,
                'uri' => $this->request->getRequestUri(),
            ],
        ]);
    }
}
