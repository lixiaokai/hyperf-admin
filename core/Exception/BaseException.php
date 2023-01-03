<?php

declare(strict_types=1);

namespace Core\Exception;

use Core\Constants\ErrorCode;

/**
 * 异常 - 抽象基类.
 */
abstract class BaseException extends \Exception
{
    public function __construct(?string $message = null, int $code = 0, \Throwable $previous = null)
    {
        is_null($message) && $message = ErrorCode::getMessage($code);
        parent::__construct($message, $code, $previous);
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'message' => $this->message,
        ];
    }
}
