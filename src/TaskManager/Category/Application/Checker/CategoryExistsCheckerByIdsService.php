<?php

namespace Netberry\TaskManager\Category\Application\Checker;

use Netberry\TaskManager\Category\Domain\CategoryNotFoundException;
use Netberry\TaskManager\Category\Domain\CategoryRepository;

class CategoryExistsCheckerByIdsService
{
    public function __construct(
        private CategoryRepository $repository
    ){
    }

    public function __invoke(array $ids): void
    {
        $result = $this->repository->existsByIds($ids);
        
        if(false === $result) {
            throw new CategoryNotFoundException();
        }
    }
}
