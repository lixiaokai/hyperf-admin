<?php

namespace Kernel\Helper;

use Hyperf\Utils\ApplicationContext;
use Hyperf\HttpServer\Contract\RequestInterface;

/**
 * 工具 - 助手类.
 */
class UtilsHelper
{
    /**
     * 获取 - 真实 IP 地址.
     */
    public static function realIp(): string
    {
        $request = ApplicationContext::getContainer()->get(RequestInterface::class);
        $headers = $request->getHeaders();
        $serverParams = $request->getServerParams();

        switch (true) {
            case ! empty($headers['x-real-ip'][0]):
                $ip = $headers['x-real-ip'][0];
                break;
            case ! empty($headers['x-forwarded-for'][0]):
                $ip = $headers['x-forwarded-for'][0];
                break;
            default:
                $ip = $serverParams['remote_addr'] ?? '';
                break;
        }

        return $ip;
    }
}
