<?php

declare(strict_types=1);

namespace Core\Repository;

use Core\Constants\RoleType;
use Core\Constants\Status;
use Core\Model\Role;
use Hyperf\Database\Model\Builder;
use Hyperf\Database\Model\Collection;

/**
 * 角色 - 仓库类.
 *
 * @method Role              getById(int $id)
 * @method Collection|Role[] getByIds(array $ids, array $columns = ['*'])
 * @method Role              create(array $data)
 * @method Role              update(Role $model, array $data)
 */
class RoleRepository extends BaseRepository
{
    protected string $modelClass = Role::class;

    /**
     * 角色 - 列表.
     *
     * @return Collection|Role[]
     */
    public function list(string $type = null, string $status = null): Collection
    {
        return $this->getQuery()
            ->when(RoleType::has($type), fn (Builder $query) => $query->where('type', $type))
            ->when(Status::has($status), fn (Builder $query) => $query->where('status', $status))
            ->orderByDesc('sort')
            ->orderBy('id')
            ->get();
    }

    /**
     * 角色 - 修改 - 关联权限菜单.
     */
    public function updateMenus(Role $role, array $menuIds): array
    {
        return $role->menus()->sync($menuIds);
    }

    /**
     * 角色 - 启用.
     */
    public function enable(Role $role): Role
    {
        $role->status = Status::ENABLE;
        $role->save();

        return $role;
    }

    /**
     * 角色 - 禁用.
     */
    public function disable(Role $role): Role
    {
        $role->status = Status::DISABLE;
        $role->save();

        return $role;
    }
}
