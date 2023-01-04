<?php

namespace Demo\Service;

use App\Repository\UserRepository;
use Hyperf\Contract\PaginatorInterface;
use Hyperf\Di\Annotation\Inject;
use Kernel\Service\BaseService;

class DemoService extends BaseService
{
    /**
     * @Inject
     */
    protected UserRepository $repo;

    public function search(array $searchParams = []): PaginatorInterface
    {
        $query = $this->repo->getQuery();

        return $this->repo->search($searchParams, $query);
    }
}
