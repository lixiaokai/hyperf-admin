<?php

namespace HyperfTest\Model\Admin;

use Core\Model\Admin\Admin;
use Hyperf\Database\Model\Collection;
use PHPUnit\Framework\TestCase;

class AdminTest extends TestCase
{
    /**
     * @see Admin::roles()
     */
    public function testRoles()
    {
        $admin = Admin::find(1);
        $roles = $admin->roles;

        self::assertInstanceOf(Collection::class, $roles);
    }
}
