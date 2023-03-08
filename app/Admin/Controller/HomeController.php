<?php

declare(strict_types=1);

namespace App\Admin\Controller;

use Core\Controller\BaseController;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\View\RenderInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * 首页 - 控制器.
 *
 * @Controller(prefix="admin/home")
 */
class HomeController extends BaseController
{
    /**
     * 首页 - 列表.
     *
     * @RequestMapping(path="", methods="get")
     */
    public function index(RenderInterface $render): ResponseInterface
    {
        return $render->render('index', ['name' => 'Hello World']);
    }
}
