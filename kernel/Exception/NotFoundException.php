<?php

namespace Kernel\Exception;

class NotFoundException extends BaseException
{
    public function __construct(string $message = '资源不存在', int $code = 404)
    {
        parent::__construct($message, $code);
    }
}
