<?php

declare(strict_types=1);

namespace Core\Service\Rbac;

use Core\Constants\ContextKey;
use Core\Constants\Platform;
use Core\Constants\Status;
use Core\Model\Menu;
use Core\Model\User;
use Core\Repository\MenuRepository;
use Core\Service\BaseService;
use Hyperf\Context\Context;
use Hyperf\Database\Model\Builder;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Relations\BelongsToMany;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Collection as UCollection;
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
     * @param  string            $platform 终端平台
     * @param  null|string       $status   菜单状态 ( 为 null 时获取所有状态 )
     * @return Collection|Menu[]
     */
    public function list(string $platform = Platform::ADMIN, string $status = null): Collection
    {
        return $this->repo->getList($platform, $status);
    }

    /**
     * 获取 - 某终端平台权限菜单树.
     *
     * 说明：默认获取总后台.
     *
     * @param null|string $platform 终端平台 ( 为 null 时表示总后台 )
     */
    public function trees(string $platform = Platform::ADMIN): array
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
     * @param string    $platform 终端平台
     * @param null|User $user     用户模型 ( 为 null 时获取当前登录用户的 )
     * @see MenuServiceTest::testUserTrees()
     */
    public function userTrees(string $platform = Platform::ADMIN, User $user = null): array
    {
        // 1. 获取用户
        is_null($user) && $user = Context::get(ContextKey::USER);

        // 2. 获取用户某终端平台菜单
        $menus = $user->isSuperAdmin() ? $this->list() : $this->userMenus($platform, $user);

        return TreeHelper::toTrees($menus->toArray());
    }

    public function userMenus(string $platform = Platform::ADMIN, User $user = null): UCollection
    {
        is_null($user) && $user = Context::get(ContextKey::USER);

        return $user->roles
            ->load(['menus' => function (BelongsToMany $query) use ($platform) {
                // Todo: 也可以考虑把这里的过滤条件放到获取之后再过滤
                // 某平台
                $query->when(Platform::has($platform), fn (Builder $query) => $query->where(Menu::column('platform'), $platform));
                // 某状态
                $query->where(Menu::column('status'), Status::ENABLE);
                // 租户终端平台时检查 appId
                $query->when($platform === Platform::TENANT, function (Builder $query) {
                    $tenant = Context::get(ContextKey::TENANT);
                    $tenantIds = $tenant->apps->where('status', Status::ENABLE)->keyBy('id'); // Todo: 进一步进行过滤，比如是否过期等
                    $query->whereIn(Menu::column('app_id'), $tenantIds);
                });
            }])
            ->pluck('menus')
            ->flatten()
            ->unique('id');
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
