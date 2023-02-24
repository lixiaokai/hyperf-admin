<?php

declare(strict_types=1);

namespace Core\Repository;

use Core\Model\Admin;
use Hyperf\Database\Model\Collection;

/**
 * 总后台用户 - 仓库类.
 *
 * @method Admin              getById(int $id)
 * @method Admin[]|Collection getByIds(array $ids, array $columns = ['*'])
 * @method Admin              create(array $data)
 * @method Admin              update(Admin $model, array $data)
 */
class AdminRepository extends BaseRepository
{
    protected string $modelClass = Admin::class;
}
