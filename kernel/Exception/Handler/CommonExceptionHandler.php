<?php

declare(strict_types=1);

namespace Kernel\Exception\Handler;

use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Utils\Codec\Json;
use Kernel\Exception\BaseException;
use Psr\Http\Message\ResponseInterface;

/**
 * 公共 - 异常处理器.
 */
class CommonExceptionHandler extends ExceptionHandler
{
    /**
     * @param BaseException $throwable
     */
    public function handle(\Throwable $throwable, ResponseInterface $response): ResponseInterface
    {
        $this->stopPropagation();

        return $response
            ->withHeader('Content-Type', 'application/json; charset=utf-8')
            ->withStatus(200)
            ->withBody(new SwooleStream(Json::encode([
                'code' => $throwable->getCode(),
                'message' => $throwable->getMessage(),
            ])));
    }

    public function isValid(\Throwable $throwable): bool
    {
        return $throwable instanceof BaseException;
    }
}
