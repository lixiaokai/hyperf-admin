<?php

declare(strict_types=1);

namespace Kernel\Repository;

use Hyperf\Database\Model\Builder;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Model;
use Hyperf\Database\Model\ModelNotFoundException;
use Kernel\Exception\DataSaveException;
use Kernel\Exception\NotFoundException;

/**
 * 仓库 - 抽象基类.
 */
abstract class BaseRepository
{
    use Searchable;

    /**
     * @var Model|string
     */
    protected string $modelClass;

    public function getQuery(): Builder
    {
        return $this->modelClass::query();
    }

    /**
     * @throws NotFoundException
     */
    public function getById(int $id, array $columns = ['*']): Model
    {
        try {
            return $this->modelClass::findOrFail($id, $columns);
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException();
        }
    }

    public function getByIds(array $ids, array $columns = ['*']): Collection
    {
        return $this->modelClass::findMany($ids, $columns);
    }

    /**
     * @throws DataSaveException
     */
    public function create(array $data): Model
    {
        try {
            return $this->modelClass::create($data);
        } catch (\Exception $e) {
            throw new DataSaveException();
        }
    }

    /**
     * @throws DataSaveException
     */
    public function update(Model $model, array $data): Model
    {
        try {
            $model->update($data);
        } catch (\Exception $e) {
            throw new DataSaveException();
        }

        return $model;
    }

    /**
     * @throws DataSaveException
     */
    public function delete(Model $model): bool
    {
        try {
            return $model->delete();
        } catch (\Exception $e) {
            throw new DataSaveException('数据删除异常');
        }
    }
}
