<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Category\Application\Finder;

use Netberry\TaskManager\Category\Domain\Category;
use Netberry\TaskManager\Category\Domain\CategoryRepository;
use Netberry\TaskManager\Category\Domain\CategoryNotFoundException;

class CategoryFinderService
{
    public function __construct(
        private CategoryRepository $repository
    ){
    }

    public function __invoke(string $id): Category
    {
        $category = $this->repository->find($id);

        if(null === $category) {
            throw new CategoryNotFoundException();
        }

        return $category;
    }
}
