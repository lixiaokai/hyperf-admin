<?php

declare(strict_types=1);

namespace Core\Service\Rbac;

use Core\Model\Role;
use Core\Repository\RoleRepository;
use Core\Service\BaseService;
use Hyperf\Database\Model\Collection;
use Hyperf\Di\Annotation\Inject;
use Kernel\Exception\BusinessException;

/**
 * 角色 - 服务类.
 */
class RoleService extends BaseService
{
    /** @Inject */
    protected RoleRepository $repo;

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
        return $this->repo->update($role, $data);
    }

    /**
     * 角色 - 修改 - 关联权限菜单.
     */
    public function updateMenus(Role $role, array $menuIds): array
    {
        return $this->repo->updateMenus($role, $menuIds);
    }

    /**
     * 角色 - 启用.
     */
    public function enable(Role $role): Role
    {
        return $this->repo->enable($role);
    }

    /**
     * 角色 - 禁用.
     */
    public function disable(Role $role): Role
    {
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
