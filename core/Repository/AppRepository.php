<?php

declare(strict_types=1);

namespace Core\Repository;

use Core\Constants\Status;
use Core\Model\App;
use Hyperf\Database\Model\Collection;

/**
 * 应用 - 仓库类.
 *
 * @method App              getById(string $id)
 * @method App[]|Collection getByIds(array $ids, array $columns = ['*'])
 * @method App              create(array $data)
 * @method App              update(App $model, array $data)
 */
class AppRepository extends BaseRepository
{
    protected string $modelClass = App::class;

    /**
     * 应用 - 启用.
     */
    public function enable(App $app): App
    {
        $app->status = Status::ENABLE;
        $app->save();

        return $app;
    }

    /**
     * 应用 - 禁用.
     */
    public function disable(App $app): App
    {
        $app->status = Status::DISABLE;
        $app->save();

        return $app;
    }
}
