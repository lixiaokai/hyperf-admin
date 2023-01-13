<?php

declare(strict_types=1);

namespace App\Tenant\Middleware;

use Core\Constants\ContextKey;
use Core\Model\User;
use Hyperf\Context\Context;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * 认证 - 中间件.
 */
class AuthMiddleware implements MiddlewareInterface
{
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $uid = 2; // Todo: 临时写死
        self::setUser($uid);

        return $handler->handle($request);
    }

    protected static function setUser(int $uid)
    {
        Context::set(ContextKey::UID, $uid);
        Context::set(ContextKey::USER, User::find($uid));
    }
}
