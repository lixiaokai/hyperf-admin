<?php

declare(strict_types=1);

namespace Kernel\Service;

use Hyperf\Di\Annotation\Inject;
use Hyperf\Logger\LoggerFactory;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;

/**
 * 服务 - 抽象基类.
 */
abstract class BaseService
{
    protected LoggerInterface $logger;

    /**
     * @Inject
     */
    protected EventDispatcherInterface $eventDispatcher;

    public function __construct(LoggerFactory $loggerFactory)
    {
        // 第 1 个参数对应日志的 name
        // 第 2 个参数对应 config/autoload/logger.php 内的 key
        $this->logger = $loggerFactory->get('Service');
    }
}
