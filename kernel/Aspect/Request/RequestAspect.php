<?php

namespace Kernel\Aspect\Request;

use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\Di\Exception\Exception;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PatchMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Kernel\Aspect\BaseAspect;
use Kernel\Helper\UtilsHelper;

/**
 * 请求路由注解 - 切面.
 *
 * @Aspect
 */
class RequestAspect extends BaseAspect
{
    public $annotations = [
        RequestMapping::class,
        GetMapping::class,
        PostMapping::class,
        PutMapping::class,
        PatchMapping::class,
        DeleteMapping::class,
    ];

    /**
     * @throws Exception
     */
    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        // 1. 调用前进行某些处理
        $this->processBefore();

        // 2. 调用原方法并获得结果
        $result = $proceedingJoinPoint->process();

        // 3. 调用后进行某些处理
        $this->processAfter();

        return $result;
    }

    protected function processBefore(): void
    {
        $this->logger->info($this->getLogMessage(), $this->getLogContext());
    }

    protected function processAfter(): void
    {
    }

    protected function getLogMessage(): string
    {
        return $this->request->getMethod() . ' ' . $this->request->getRequestUri();
    }

    protected function getLogContext(): array
    {
        return [
            'params' => $this->request->all(),
            'userIp' => UtilsHelper::realIp(),
            'userAgent' => $this->request->getHeaders()['user-agent'][0] ?? '',
        ];
    }
}
