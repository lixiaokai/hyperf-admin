<?php

declare(strict_types=1);

namespace Core\Monolog\Handler;

use Monolog\Logger;

class StreamHandler extends \Monolog\Handler\StreamHandler
{
    /**
     * 是否 - 处理日志.
     *
     * 说明：重写该方法，使得 [info、waring、notice] [debug] [error] 级别日志单独存储
     */
    public function isHandling(array $record): bool
    {
        switch ($record['level']) {
            case Logger::DEBUG:
                return $record['level'] == $this->level;
            case $record['level'] >= Logger::ERROR:
                return $this->level >= Logger::ERROR && $this->level <= Logger::EMERGENCY;
            default:
                return $this->level >= Logger::INFO && $this->level <= Logger::WARNING;
        }
    }
}
