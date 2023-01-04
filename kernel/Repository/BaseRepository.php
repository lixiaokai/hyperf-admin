<?php

declare(strict_types=1);

namespace Kernel\Repository;

use Kernel\Exception\DataSaveException;
use Kernel\Exception\NotFoundException;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Model;
use Hyperf\Database\Model\ModelNotFoundException;

/**
 * 仓库 - 抽象基类.
 */
abstract class BaseRepository
{
    /**
     * @var Model|string
     */
    protected string $modelClass;

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
     * @throws \Exception
     */
    public function delete(Model $model): bool
    {
        return $model->delete();
    }
}
