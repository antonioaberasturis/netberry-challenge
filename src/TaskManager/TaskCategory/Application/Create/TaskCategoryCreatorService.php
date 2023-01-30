<?php

declare(strict_types=1);

namespace Netberry\TaskManager\TaskCategory\Application\Create;

use Netberry\TaskManager\TaskCategory\Domain\TaskCategory;
use Netberry\TaskManager\TaskCategory\Domain\TaskCategoryRepository;

class TaskCategoryCreatorService
{
    public function __construct(
        private TaskCategoryRepository $repository,
    ){
    }

    public function __invoke(string $taskId, array $categoryIds): void
    {
        foreach($categoryIds as $categoryId){
            $taskCategory = new TaskCategory(
                taskId:     $taskId,
                categoryId: $categoryId,
            );
            
            $this->repository->save($taskCategory);
        }
    }
}
