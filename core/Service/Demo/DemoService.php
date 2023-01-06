<?php

namespace Core\Service\Demo;

use Core\Repository\UserRepository;
use Core\Service\BaseService;
use Hyperf\Contract\PaginatorInterface;
use Hyperf\Di\Annotation\Inject;

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
