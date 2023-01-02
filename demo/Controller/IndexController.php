<?php

declare(strict_types=1);

namespace Demo\Controller;

use App\Controller\AbstractController;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;

/**
 * 演示首页 - 控制器.
 *
 * @Controller(prefix="demo")
 */
class IndexController extends AbstractController
{
    /**
     * 演示 - 列表.
     *
     * @GetMapping(path="")
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
     * @GetMapping(path="{id:\d+}")
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
