<?php

declare(strict_types=1);

namespace Kernel\Response;

use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Utils\Codec\Json;
use Hyperf\Context\Context;
use Psr\Http\Message\ResponseInterface;

/**
 * 响应类.
 */
class Response
{
    /**
     * @var mixed
     */
    protected $data;

    protected string $message = '';

    /**
     * @param mixed $data
     */
    public function __construct($data = [], string $message = '')
    {
        $this->data = $data;
        $this->message = $message;
    }

    public static function withEmpty(): ResponseInterface
    {
        return (new self())->toJson();
    }

    /**
     * @param mixed $data
     */
    public static function withData($data = [], string $message = ''): ResponseInterface
    {
        return (new self($data))->toJson();
    }

    /**
     * @param mixed $data
     */
    public static function success($data = [], string $message = '操作成功'): ResponseInterface
    {
        return (new self($data, $message))->toJson();
    }

    protected function toJson(): ResponseInterface
    {
        return $this->response()
            ->withStatus(200)
            ->withAddedHeader('content-type', 'application/json; charset=utf-8')
            ->withBody(new SwooleStream(Json::encode([
                'code' => 200,
                'message' => $this->message,
                'data' => $this->data,
            ])));
    }

    protected function response(): ResponseInterface
    {
        return Context::get(ResponseInterface::class);
    }
}
