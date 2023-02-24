<?php

namespace HyperfTest\Model;

use Core\Model\Admin;
use Core\Model\Menu;
use Core\Model\Role;
use Core\Model\Tenant;
use Core\Model\User;
use Hyperf\Database\Model\Collection;
use Hyperf\Utils\Collection as UCollection;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @see User::admin()
     */
    public function testAdmin()
    {
        $user = User::find(1);

        self::assertInstanceOf(Admin::class, $user->admin);
    }

    /**
     * @see User::roles()
     */
    public function testRoles()
    {
        $user = User::find(2);

        self::assertInstanceOf(Collection::class, $user->roles);
        self::assertInstanceOf(Role::class, $user->roles->first());
    }

    /**
     * @see User::tenants()
     */
    public function testTenants()
    {
        $user = User::find(2);

        self::assertInstanceOf(Collection::class, $user->tenants);
        self::assertInstanceOf(Tenant::class, $user->tenants->first());
    }

    /**
     * @see User::menus()
     */
    public function testMenus()
    {
        $user = User::find(2);
        $menus = $user->menus();

        self::assertInstanceOf(UCollection::class, $menus);
        self::assertInstanceOf(Menu::class, $menus->first());
    }
}
