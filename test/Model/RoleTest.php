<?php

namespace HyperfTest\Model;

use Core\Model\Role;
use Hyperf\Database\Model\Collection;
use PHPUnit\Framework\TestCase;

class RoleTest extends TestCase
{
    public function testMenus()
    {
        $role = Role::find(2);

        self::assertInstanceOf(Collection::class, $role->menus);
    }
}
