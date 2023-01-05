<?php

namespace Kernel\Aspect;

use Hyperf\Di\Annotation\Inject;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Logger\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * 切面 - 抽象基类.
 */
abstract class BaseAspect extends AbstractAspect
{
    /**
     * @Inject
     */
    protected RequestInterface $request;

    protected LoggerInterface $logger;

    public function __construct(LoggerFactory $loggerFactory)
    {
        $this->logger = $loggerFactory->get('aspect');
    }
}
