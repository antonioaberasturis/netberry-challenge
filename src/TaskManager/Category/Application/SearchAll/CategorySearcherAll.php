<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Category\Application\SearchAll;

use Netberry\TaskManager\Category\Domain\Category;
use Netberry\TaskManager\Category\Domain\CategoryRepository;
use Netberry\TaskManager\Category\Application\CategoryResponse;
use Netberry\TaskManager\Category\Application\CategoryResponses;

class CategorySearcherAll
{
    public function __construct(
        private CategoryRepository $repository
    ){
    }

    public function __invoke(): CategoryResponses
    {
        $categories = $this->repository->searchAll();

        $responses = $categories->map( fn(Category $category): CategoryResponse => 
                        new CategoryResponse(
                            id:   $category->getId(),
                            name: $category->getName(),
                    ));

        return new CategoryResponses($responses);
    }
}
