<?php

declare(strict_types=1);

namespace Core\Repository;

use Core\Constants\MenuType;
use Core\Constants\Platform;
use Core\Constants\Status;
use Core\Model\App;
use Core\Model\Menu;
use Hyperf\Database\Model\Builder;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Relations\HasMany;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Collection as UCollection;
use Kernel\Helper\TreeHelper;

/**
 * 权限菜单 - 仓库类.
 *
 * @method Menu              getById(int $id)
 * @method Collection|Menu[] getByIds(array $ids, array $columns = ['*'])
 * @method Menu              create(array $data)
 * @method Menu              update(Menu $model, array $data)
 */
class MenuRepository extends BaseRepository
{
    protected string $modelClass = Menu::class;

    /** @Inject */
    protected AppRepository $appRepo;

    /**
     * 权限菜单 - 获取 - 总后台所有权限菜单树.
     */
    public function getAdminTrees(string $status = null): array
    {
        $menus = $this->getQuery()
            ->where(Menu::column('platform'), Platform::ADMIN)
            ->when(Status::has($status), fn (Builder $query) => $query->where(Menu::column('status'), $status))
            ->orderByDesc(Menu::column('sort'))
            ->orderBy(Menu::column('id'))
            ->get();

        return TreeHelper::toTrees(self::buildMenus($menus)->toArray());
    }

    /**
     * 权限菜单 - 获取 - 租户后台所有权限菜单树.
     *
     * 说明：包含顶层应用菜单.
     */
    public function getTenantTrees(string $status = null): array
    {
        $appMenus = $this->appRepo->list(Status::ENABLE)
            ->load(['menus' => function (HasMany $query) use ($status) {
                $query->when(Status::has($status), fn (Builder $query) => $query->where(Menu::column('status'), $status))
                    ->orderByDesc(Menu::column('sort'))
                    ->orderBy(Menu::column('id'));
            }])
            ->map(function (App $app) {
                return [
                    'id' => $app->id,
                    'parentId' => 0,
                    'name' => $app->name,
                    'type' => MenuType::MENU,
                    'status' => $app->status,
                    'children' => TreeHelper::toTrees(self::buildMenus($app->menus)->toArray()),
                ];
            });

        return $appMenus->toArray();
    }

    /**
     * 权限菜单 - 启用.
     */
    public function enable(Menu $menu): Menu
    {
        $menu->status = Status::ENABLE;
        $menu->save();

        return $menu;
    }

    /**
     * 权限菜单 - 禁用.
     */
    public function disable(Menu $menu): Menu
    {
        $menu->status = Status::DISABLE;
        $menu->save();

        return $menu;
    }

    /**
     * 权限菜单 - 获取 - 组装后的数据.
     */
    protected static function buildMenus(Collection $menus): UCollection
    {
        return $menus->map(function (Menu $menu) {
            return [
                'id' => $menu->id,
                'parentId' => $menu->parentId,
                'name' => $menu->name,
                'remark' => $menu->remark,
                'method' => $menu->method,
                'path' => $menu->path,
                'uri' => $menu->uri,
                'icon' => $menu->icon,
                'type' => $menu->type,
                'status' => $menu->status,
            ];
        });
    }
}
