<?php

namespace HyperfTest\Service\Rbac;

use Core\Model\Role;
use Core\Service\Rbac\MenuService;
use Core\Service\Rbac\RoleService;
use PHPUnit\Framework\TestCase;

class RoleServiceTest extends TestCase
{
    protected RoleService $roleService;

    protected MenuService $menuService;

    public function setUp(): void
    {
        $this->roleService = make(RoleService::class);
        $this->menuService = make(MenuService::class);
    }

    /**
     * @see RoleService::updateMenus()
     */
    public function testUpdateMenus()
    {
        $role = Role::find(1);
        $this->roleService->updateMenus($role, [2]);

        self::assertTrue(true);
    }
}
