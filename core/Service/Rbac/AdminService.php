<?php

declare(strict_types=1);

namespace Core\Service\Rbac;

use Core\Model\Admin;
use Core\Repository\AdminRepository;
use Core\Service\BaseService;
use Hyperf\Contract\PaginatorInterface;
use Hyperf\Di\Annotation\Inject;
use Kernel\Exception\BusinessException;

/**
 * 总后台用户 - 服务类.
 */
class AdminService extends BaseService
{
    /** @Inject */
    protected AdminRepository $repo;

    /**
     * 总后台用户 - 列表.
     */
    public function search(array $searchParams = []): PaginatorInterface
    {
        $query = $this->repo->getQuery()->with('user');

        return $this->repo->search($searchParams, $query);
    }

    /**
     * 总后台用户 - 详情.
     */
    public function get(int $id): Admin
    {
        try {
            $admin = $this->repo->getById($id);
        } catch (BusinessException $e) {
            throw new BusinessException('该用户不存在');
        }

        return $admin;
    }

    /**
     * 总后台用户 - 创建.
     */
    public function create(array $data): Admin
    {
        return $this->repo->create($data);
    }

    /**
     * 总后台用户 - 修改.
     */
    public function update(Admin $admin, array $data): Admin
    {
        return $this->repo->update($admin, $data);
    }

    /**
     * 总后台用户 - 启用.
     */
    public function enable(Admin $admin): Admin
    {
        return $this->repo->enable($admin);
    }

    /**
     * 总后台用户 - 禁用.
     */
    public function disable(Admin $admin): Admin
    {
        return $this->repo->disable($admin);
    }
}
