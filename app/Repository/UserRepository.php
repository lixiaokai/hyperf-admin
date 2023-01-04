<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\User;
use Kernel\Repository\BaseRepository;
use Hyperf\Database\Model\Collection;

/**
 * 用户信息 - 仓库类.
 *
 * @method User              getById(string $id)
 * @method Collection|User[] getByIds(array $ids, array $columns = ['*'])
 * @method User              create(array $data)
 * @method User              update(User $model, array $data)
 */
class UserRepository extends BaseRepository
{
    protected string $modelClass = User::class;
}
