<?php

declare(strict_types=1);

namespace Kernel\Exception\Handler;

use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Logger\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * 托底 - 异常处理器.
 *
 * 说明：该异常处理器务必放在 config/autoload/exceptions.php 配置的最后，起到拖底的作用
 */
class AppExceptionHandler extends ExceptionHandler
{
    protected LoggerInterface $logger;

    public function __construct(LoggerFactory $loggerFactory)
    {
        $this->logger = $loggerFactory->get('Exception');
    }

    public function handle(\Throwable $throwable, ResponseInterface $response): ResponseInterface
    {
        $this->stopPropagation();

        $this->log($throwable);

        return $response
            ->withHeader('Server', 'Hyperf')
            ->withStatus(500)
            ->withBody(new SwooleStream('Internal Server Error.'));
    }

    public function isValid(\Throwable $throwable): bool
    {
        return true;
    }

    /**
     * 记录 - 日志.
     */
    protected function log(\Throwable $throwable): void
    {
        $message = sprintf('%s on line %s in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile());
        $message .= PHP_EOL . $throwable->getTraceAsString();
        $this->logger->error($message);
    }
}
