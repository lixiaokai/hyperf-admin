<?php

declare(strict_types=1);

namespace Core\Service\Rbac;

use Core\Repository\UserRepository;
use Core\Service\BaseService;
use Hyperf\Di\Annotation\Inject;

/**
 * 用户 - 服务类.
 */
class UserService extends BaseService
{
    /** @Inject */
    protected UserRepository $repo;
}
