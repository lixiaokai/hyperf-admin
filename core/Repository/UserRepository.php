<?php

declare(strict_types=1);

namespace Core\Repository;

use Core\Model\User;
use Hyperf\Database\Model\Collection;

/**
 * 用户信息 - 仓库类.
 *
 * @method User              getById(int $id)
 * @method Collection|User[] getByIds(array $ids, array $columns = ['*'])
 * @method User              create(array $data)
 * @method User              update(User $model, array $data)
 */
class UserRepository extends BaseRepository
{
    protected string $modelClass = User::class;
}
