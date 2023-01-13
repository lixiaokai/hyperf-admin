<?php

namespace Core\Service;

use Core\Model\App;
use Core\Repository\AppRepository;
use Hyperf\Contract\PaginatorInterface;
use Hyperf\Database\Model\Collection;
use Hyperf\Di\Annotation\Inject;
use Kernel\Exception\BusinessException;

/**
 * 应用 - 服务类.
 */
class AppService extends BaseService
{
    /** @Inject */
    protected AppRepository $repo;

    /**
     * 应用 - 列表 ( 含筛选 ).
     */
    public function search(array $searchParams = []): PaginatorInterface
    {
        $query = $this->repo->getQuery()
            ->orderByDesc('sort')
            ->orderBy('id');

        return $this->repo->search($searchParams, $query);
    }

    /**
     * 应用 - 列表.
     *
     * @return App[]|Collection
     */
    public function list(string $status = null): Collection
    {
        return $this->repo->list();
    }

    /**
     * 应用 - 详情.
     */
    public function get(int $id): App
    {
        try {
            $app = $this->repo->getById($id);
        } catch (BusinessException $e) {
            throw new BusinessException('该应用不存在');
        }

        return $app;
    }

    /**
     * 应用 - 创建.
     */
    public function create(array $data): App
    {
        return $this->repo->create($data);
    }

    /**
     * 应用 - 修改.
     */
    public function update(App $app, array $data): App
    {
        return $this->repo->update($app, $data);
    }

    /**
     * 应用 - 启用.
     */
    public function enable(App $app): App
    {
        return $this->repo->enable($app);
    }

    /**
     * 应用 - 禁用.
     */
    public function disable(App $app): App
    {
        return $this->repo->disable($app);
    }

    /**
     * 应用 - 删除.
     */
    public function delete(App $app): bool
    {
        if (! $app->canDelete()) {
            throw new BusinessException('该应用不允许删除');
        }

        return $this->repo->delete($app);
    }
}
