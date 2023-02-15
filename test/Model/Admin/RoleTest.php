<?php

namespace HyperfTest\Model\Admin;

use Core\Model\Admin\Role;
use Hyperf\Database\Model\Collection;
use PHPUnit\Framework\TestCase;

class RoleTest extends TestCase
{

    /**
     * @see Role::admins()
     */
    public function testAdmins()
    {
        $role = Role::find(1);
        $admins = $role->admins;

        self::assertInstanceOf(Collection::class, $admins);
    }
}
