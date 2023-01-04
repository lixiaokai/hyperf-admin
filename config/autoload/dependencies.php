<?php

declare(strict_types=1);

/**
 * DI 的依赖关系和类对应关系 - 配置.
 */
return [
    Hyperf\Database\Commands\Ast\ModelUpdateVisitor::class => Kernel\Model\Visitor\ModelUpdateVisitor::class,
];
