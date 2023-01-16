<?php

declare(strict_types=1);

namespace Core\Service\Rbac;

use Core\Model\Role;
use Core\Repository\RoleRepository;
use Core\Service\BaseService;
use Hyperf\Database\Model\Collection;
use Hyperf\Di\Annotation\Inject;
use Kernel\Exception\BusinessException;
use Kernel\Helper\TreeHelper;

/**
 * 角色 - 服务类.
 */
class RoleService extends BaseService
{
    /** @Inject */
    protected RoleRepository $repo;

    /** @Inject */
    protected MenuService $menuService;

    /**
     * 角色 - 列表.
     *
     * @return Collection|Role[]
     */
    public function list(string $type = null, string $status = null): Collection
    {
        return $this->repo->list($type, $status);
    }

    /**
     * 角色 - 详情.
     */
    public function get(int $id): Role
    {
        try {
            $role = $this->repo->getById($id);
        } catch (BusinessException $e) {
            throw new BusinessException('该角色不存在');
        }

        return $role;
    }

    /**
     * 角色 - 创建.
     */
    public function create(array $data): Role
    {
        return $this->repo->create($data);
    }

    /**
     * 角色 - 修改 - 基础信息.
     */
    public function update(Role $role, array $data): Role
    {
        if ($role->isSuperAdmin()) {
            throw new BusinessException('该角色为超级管理员，不允许操作');
        }

        return $this->repo->update($role, $data);
    }

    /**
     * 角色 - 修改 - 关联权限菜单.
     *
     * 说明：前端提交的菜单 ID 可能会缺少上级父类，需要再次处理
     *
     * @see RoleServiceTest::testUpdateMenus()
     */
    public function updateMenus(Role $role, array $menuIds): array
    {
        if ($role->isSuperAdmin()) {
            throw new BusinessException('该角色为超级管理员，不允许操作');
        }

        // 1. 获取角色所属平台的菜单
        $arrayMenus = $this->menuService->list($role->platformKey)->toArray();

        // 2. 获取可能缺失的父级菜单
        $menus = [];
        foreach ($menuIds as $menuId) {
            $menus += TreeHelper::findParents($arrayMenus, $menuId);
        }

        return $this->repo->updateMenus($role, array_keys($menus));
    }

    /**
     * 角色 - 启用.
     */
    public function enable(Role $role): Role
    {
        if ($role->isSuperAdmin()) {
            throw new BusinessException('该角色为超级管理员，不允许操作');
        }

        return $this->repo->enable($role);
    }

    /**
     * 角色 - 禁用.
     */
    public function disable(Role $role): Role
    {
        if ($role->isSuperAdmin()) {
            throw new BusinessException('该角色为超级管理员，不允许操作');
        }

        return $this->repo->disable($role);
    }

    /**
     * 角色 - 删除.
     */
    public function delete(Role $role): bool
    {
        if (! $role->canDelete()) {
            throw new BusinessException('该角色不允许删除');
        }

        return $this->repo->delete($role);
    }
}
