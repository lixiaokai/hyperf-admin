<?php

declare(strict_types=1);

namespace Core\Service\Rbac;

use Core\Constants\ContextKey;
use Core\Constants\Platform;
use Core\Model\Menu;
use Core\Model\User;
use Core\Repository\MenuRepository;
use Core\Service\BaseService;
use Hyperf\Context\Context;
use Hyperf\Database\Model\Collection;
use Hyperf\Di\Annotation\Inject;
use Kernel\Exception\BusinessException;
use Kernel\Helper\TreeHelper;

/**
 * 权限菜单 - 服务类.
 */
class MenuService extends BaseService
{
    /** @Inject */
    protected MenuRepository $repo;

    /**
     * 获取 - 某终端平台权限菜单.
     *
     * @return Collection|Menu[]
     */
    public function list(string $platform = null, string $status = null): Collection
    {
        return $this->repo->getList($platform, $status);
    }

    /**
     * 获取 - 某终端平台权限菜单树.
     *
     * 说明：默认获取总后台.
     */
    public function trees(string $platform = null): array
    {
        switch ($platform) {
            case Platform::TENANT: // 租户后台
                $menuTrees = $this->repo->getTenantTrees();
                break;
            default: // 总后台
                $menuTrees = $this->repo->getAdminTrees();
        }

        return $menuTrees;
    }

    /**
     * 获取 - 某用户的权限菜单树.
     *
     * @param null|User $user 用户模型 ( 为 null 时获取当前登录用户的 )
     * @see MenuServiceTest::testUserTrees()
     */
    public function userTrees(User $user = null): array
    {
        // 1. 获取用户
        if (is_null($user)) {
            $user = Context::get(ContextKey::USER);
        }

        // 2. 获取用户菜单
        $menus = $user->isSuperAdmin() ? $this->list(Platform::ADMIN) : $user->menus();

        // Todo: 用户获取菜单的方式不对，待修改成根据应用方式
        // Todo: 过滤应用到期或关闭等菜单

        return TreeHelper::toTrees($menus->toArray());
    }

    /**
     * 权限菜单 - 详情.
     */
    public function get(int $id): Menu
    {
        try {
            $menu = $this->repo->getById($id);
        } catch (BusinessException $e) {
            throw new BusinessException('该权限菜单不存在');
        }

        return $menu;
    }

    /**
     * 权限菜单 - 创建.
     */
    public function create(array $data): Menu
    {
        return $this->repo->create($data);
    }

    /**
     * 权限菜单 - 修改.
     */
    public function update(Menu $menu, array $data): Menu
    {
        return $this->repo->update($menu, $data);
    }

    /**
     * 权限菜单 - 启用.
     */
    public function enable(Menu $menu): Menu
    {
        return $this->repo->enable($menu);
    }

    /**
     * 权限菜单 - 禁用.
     */
    public function disable(Menu $menu): Menu
    {
        return $this->repo->disable($menu);
    }

    /**
     * 权限菜单 - 删除.
     */
    public function delete(Menu $menu): bool
    {
        if (! $menu->canDelete()) {
            throw new BusinessException('该权限菜单不允许删除');
        }

        return $this->repo->delete($menu);
    }
}
