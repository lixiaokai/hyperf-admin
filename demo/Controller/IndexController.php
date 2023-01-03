<?php

declare(strict_types=1);

namespace Demo\Controller;

use Core\Controller\BaseController;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;

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
    public function list(): array
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }

    /**
     * 演示 - 详情.
     *
     * @RequestMapping(path="{id:\d+}", methods="get")
     */
    public function detail(int $id): array
    {
        return [
            'method' => $this->request->getMethod(),
            'data' => [
                'id' => $id,
                'uri' => $this->request->getRequestUri(),
            ],
        ];
    }
}
