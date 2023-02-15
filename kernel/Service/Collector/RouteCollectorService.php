<?php

declare(strict_types=1);

namespace Kernel\Service\Collector;

use Core\Constants\Platform;
use Core\Model\Admin\Permission as AdminPermission;
use Hyperf\DbConnection\Annotation\Transactional;
use Hyperf\Di\Annotation\AnnotationCollector;
use Hyperf\HttpServer\Router\DispatcherFactory;
use Hyperf\HttpServer\Router\Handler;
use Hyperf\Utils\Codec\Json;
use Hyperf\Utils\Collection;
use Kernel\Annotation\Permission\AdditionalPermissions;
use Kernel\Service\BaseService;
use phpDocumentor\Reflection\DocBlockFactory;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * 路由收集器 - 服务类.
 *
 * @see RoutesCommand::class 参考通过命令行获取路由信息
 */
class RouteCollectorService extends BaseService
{
    protected array $data;

    protected DocBlockFactory $docFactory;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->docFactory = DocBlockFactory::createInstance();
        $this->data = $this->analyzeRouter();
    }

    /**
     * 初始化 - 路由权限.
     *
     * 说明：
     * 1. 可多次运行.
     * 2. 新增权限路由时都必须运行一次.
     *
     * @see RouteCollectorServiceTest::testInit()
     * @Transactional
     */
    public function init(): void
    {
        $additionalPermissions = $this->getAdditionalPermissions();

        // Todo: 总后台、卖价后台分开的话，权限表也待分开
        collect($this->getRoutes())
            // 过滤未定义的终端平台
            ->filter(fn (array $item) => $this->isAllowPlatform($item['platform']))
            ->sortBy('uri')
            ->map(function (array $item) use ($additionalPermissions) {
                // 附加路由
                $additionalRoutes = data_get($additionalPermissions, $item['action']);
                if (! empty($additionalRoutes)) {
                    $additionalRoutes = Json::encode($additionalRoutes);
                }

                return [
                    'platform' => $item['platform'],
                    'method' => $item['method'],
                    'route' => $item['route'],
                    'additional_routes' => $additionalRoutes,
                    'desc' => $item['desc'],
                    'deleted_at' => null,
                ];
            })
            ->groupBy('platform')
            ->each(function (Collection $permissions, $platform) {
                switch ($platform) {
                    case Platform::ADMIN:
                        AdminPermission::query()->delete();
                        AdminPermission::insertOnDuplicateKey($permissions->values()->toArray());
                        break;
                    case Platform::SELLER:
                    default:
                        break;
                }
            });
    }

    /**
     * 获取 - 所有路由.
     *
     * @see RouteCollectorServiceTest::testGetRoutes()
     * @example return
     * ```
     * [
     *   "server" => "http"
     *   "method" => "POST"
     *   "uri" => "/admin/app" // 静态路由
     *   "action" => "App\Admin\Controller\AppController::create"
     *   "desc" => "应用 - 列表"
     * ],
     * [
     *   "server" => "http"
     *   "method" => "GET"
     *   "uri" => "/health"
     *   "action" => "Closure" // 动作为回调函数
     *   "desc" => ""
     * ],
     * [
     *   "server" => "http"
     *   "method" => "DELETE"
     *   "uri" => "/admin/app/{id}" // 动态路由
     *   "action" => "App\Admin\Controller\AppController::delete"
     *   "desc" => "应用 - 详情"
     * ]
     * ```
     */
    public function getRoutes(): array
    {
        return $this->data;
    }

    /**
     * 获取 - 附加路由权限.
     *
     * 说明：
     * 1. 通过注解方式获取.
     * 2. 有些权限节点需要多个权限组合，这时就需要用到附加路由权限.
     *
     * @see RouteCollectorServiceTest::testGetAdditionalPermissions()
     */
    public function getAdditionalPermissions(): Collection
    {
        return collect(AnnotationCollector::getMethodsByAnnotation(AdditionalPermissions::class))
            ->map(function (array $item) {
                /* @var AdditionalPermissions $annotation */
                ['class' => $class, 'method' => $method, 'annotation' => $annotation] = $item;

                return [
                    'action' => $class . '::' . $method,
                    'routes' => $annotation->routes,
                ];
            })->pluck('routes', 'action');
    }

    /**
     * 获取 - 控制器第一行注释.
     */
    protected function getRouteDesc(string $controller, string $method): string
    {
        try {
            $method = new \ReflectionMethod($controller, $method);
        } catch (\Exception $e) {
            return '';
        }

        $docBlock = $this->docFactory->create($method->getDocComment());

        return rtrim(trim($docBlock->getSummary(), '* '), '.');
    }

    /**
     * 分析 - 全局路由.
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function analyzeRouter(): array
    {
        $serverName = 'http';
        $factory = $this->container->get(DispatcherFactory::class);
        $router = $factory->getRouter($serverName);

        $data = [];
        [$staticRouters, $variableRouters] = $router->getData();

        foreach ($staticRouters as $method => $items) {
            foreach ($items as $handler) {
                $data[] = $this->analyzeHandler($serverName, $method, $handler);
            }
        }

        foreach ($variableRouters as $method => $items) {
            foreach ($items as $item) {
                if (is_array($item['routeMap'] ?? false)) {
                    foreach ($item['routeMap'] as [$handler]) {
                        $data[] = $this->analyzeHandler($serverName, $method, $handler);
                    }
                }
            }
        }

        return $data;
    }

    /**
     * 分析处理器.
     */
    protected function analyzeHandler(string $serverName, string $method, Handler $handler): array
    {
        // 动作
        if (is_array($handler->callback)) {
            $action = $handler->callback[0] . '::' . $handler->callback[1];
        } elseif (is_string($handler->callback)) {
            $action = $handler->callback;
        } elseif (is_callable($handler->callback)) {
            $action = 'Closure';
        } else {
            $action = (string) $handler->callback;
        }

        // 描述
        $desc = is_array($handler->callback) ? $this->getRouteDesc($handler->callback[0], $handler->callback[1]) : '';

        // 平台
        $platform = data_get(explode('/', $handler->route), 1, '');

        return [
            'server' => $serverName,
            'platform' => $platform,
            'method' => $method,
            'route' => $handler->route,
            'action' => $action,
            'desc' => $desc,
        ];
    }

    /**
     * 是否 - 允许的终端平台.
     */
    protected function isAllowPlatform(string $platform): bool
    {
        return in_array($platform, Platform::codes());
    }
}
