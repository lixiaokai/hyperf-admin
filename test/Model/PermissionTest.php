<?php

declare(strict_types=1);

namespace HyperfTest\Model;

use Core\Model\Permission;
use Hyperf\Database\Model\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class PermissionTest extends TestCase
{
    /**
     * @see Permission::roles()
     */
    public function testRoles()
    {
        $permission = Permission::find(1);
        $roles = $permission->roles;
        var_dump($roles);

        self::assertInstanceOf(Collection::class, $roles);
    }
}
