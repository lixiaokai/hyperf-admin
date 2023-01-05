<?php

declare(strict_types=1);

namespace Kernel\Helper;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Utils\ApplicationContext;

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
            case ! empty($serverParams['http_client_ip']):
                $ip = $serverParams['http_client_ip'];
                break;
            case ! empty($serverParams['http_x_real_ip']):
                $ip = $serverParams['http_x_real_ip'];
                break;
            case ! empty($serverParams['http_x_forwarded_for']):
                // 部分 CDN 会获取多层代理 IP，所以转成数组取第一个值
                $ip = explode(',', $serverParams['http_x_forwarded_for'])[0];
                break;
            default:
                $ip = $serverParams['remote_addr'] ?? '';
                break;
        }

        return $ip;
    }
}
