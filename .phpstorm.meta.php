<?php

namespace PHPSTORM_META {

    // Reflect
    override(\Psr\Container\ContainerInterface::get(0), map('@'));
    override(\Hyperf\Context\Context::get(), map([
        'user' => \Core\Model\User::class,
        'tenant' => \Core\Model\Tenant::class,
        0 => '@'
    ]));
    override(\make(0), map('@'));
    override(\di(0), map('@'));

}