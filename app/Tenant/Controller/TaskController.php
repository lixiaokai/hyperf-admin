<?php

declare(strict_types=1);

namespace App\Tenant\Controller;

use App\Tenant\Middleware\AuthMiddleware;
use App\Tenant\Middleware\PermissionMiddleware;
use Core\Controller\BaseController;
use Core\Request\SearchRequest;
use Core\Response\Response;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\Middlewares;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Psr\Http\Message\ResponseInterface;

/**
 * 任务管理 - 控制器.
 *
 * @Controller(prefix="tenant/task")
 * @Middlewares({
 *     @Middleware(AuthMiddleware::class),
 *     @Middleware(PermissionMiddleware::class)
 * })
 */
class TaskController extends BaseController
{
    /**
     * 任务管理 - 列表.
     *
     * @RequestMapping(path="", methods="get")
     */
    public function index(SearchRequest $request): ResponseInterface
    {
        return Response::success([], '任务管理 - 列表');
    }
}
