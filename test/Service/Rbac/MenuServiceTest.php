<?php

namespace HyperfTest\Service\Rbac;

use Core\Constants\Platform;
use Core\Model\User;
use Core\Service\Rbac\MenuService;
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
        $user = User::find(1);
        $trees = $this->menuService->userTrees($user);
        self::assertSame(Platform::ADMIN, $trees[0]['platform']);

        $user = User::find(2);
        $trees = $this->menuService->userTrees($user);
        self::assertSame(Platform::TENANT, $trees[0]['platform']);

        self::assertTrue(true);
    }
}
