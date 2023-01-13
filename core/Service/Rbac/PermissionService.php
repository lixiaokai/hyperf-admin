<?php

namespace Core\Service\Rbac;

use Core\Model\Menu;
use Core\Model\User;
use Core\Service\BaseService;
use FastRoute\RouteCollector;
use Hyperf\HttpServer\Router\Dispatched;
use Hyperf\Utils\Collection as UCollection;
use Kernel\Constants\ErrorCode;
use Kernel\Exception\BusinessException;
use function FastRoute\simpleDispatcher;

/**
 * 权限 - 服务类.
 */
class PermissionService extends BaseService
{
    /**
     * 权限 - 检查.
     */
    public function check(string $method, string $uri)
    {
        // 如果找不到路由
        if (! $this->isFoundRoute($method, $uri)) {
            throw new BusinessException(null, ErrorCode::FORBIDDEN);
        }
    }

    /**
     * 获取 - 用户所有权限.
     *
     * @return Menu[]|UCollection
     */
    public function getPermissions(int $uid = null): UCollection
    {
        // Todo: 临时写死
        $user = User::find(2);

        return $user->allMenus();
    }

    /**
     * 是否 - 找到路由.
     */
    protected function isFoundRoute(string $method, string $uri): bool
    {
        // 路由调度器：收集路由信息 ( 收集我拥有的权限 )
        $dispatcher = simpleDispatcher(function (RouteCollector $r) {
            $this->getPermissions()->each(function (Menu $menu) use ($r) {
                if (! empty($menu->method) && ! empty($menu->uri)) {
                    $r->addRoute($menu->method, $menu->uri, '');
                }
            });
        });
        // 路由调度器：分配路由请求并获取返回的路由匹配信息
        $routeInfo = $dispatcher->dispatch($method, $uri);

        // 判断路由是否找到
        return (new Dispatched($routeInfo))->isFound();
    }
}
