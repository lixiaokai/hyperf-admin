<?php

namespace HyperfTest\Service\Rbac;

use Core\Constants\ContextKey;
use Core\Constants\Platform;
use Core\Model\Tenant;
use Core\Model\User;
use Core\Service\Rbac\MenuService;
use Hyperf\Context\Context;
use PHPUnit\Framework\TestCase;

class MenuServiceTest extends TestCase
{
    protected MenuService $menuService;

    public function setUp(): void
    {
        $this->menuService = make(MenuService::class);
    }

    /**
     * @see MenuService::userTrees()
     */
    public function testUserTrees()
    {
        self::assertTrue(true);
    }

    /**
     * @see MenuService::userTrees()
     */
    public function testAdminTrees()
    {
        $user = User::find(1);
        $trees = $this->menuService->userTrees(Platform::ADMIN, $user);
        self::assertSame(Platform::ADMIN, $trees[0]['platform']);
    }

    /**
     * @see MenuService::userTrees()
     */
    public function testTenantTrees()
    {
        Context::set(ContextKey::TENANT, Tenant::find(1));

        $user = User::find(2);
        $trees = $this->menuService->userTrees(Platform::TENANT, $user);
        self::assertSame(Platform::TENANT, $trees[0]['platform']);
    }
}
