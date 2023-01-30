<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Task\Application\SearchAll;

use Netberry\TaskManager\Task\Domain\Task;
use Netberry\TaskManager\Category\Domain\Category;
use Netberry\TaskManager\Task\Domain\TaskRepository;
use Netberry\TaskManager\Task\Application\TaskResponse;
use Netberry\TaskManager\Task\Application\TaskResponses;
use Netberry\TaskManager\Task\Application\TaskSearchAllData;
use Netberry\TaskManager\Category\Application\CategoryResponse;

class TaskSearcherAll
{
    public function __construct(
        private TaskRepository $repository
    ){
    }

    public function __invoke(): TaskResponses
    {
        $tasks = $this->repository->searchAll();

        $responses = $tasks->map( fn(Task $task): TaskResponse => 
                        new TaskResponse(
                            id:         $task->getId(),
                            name:       $task->getName(),
                            categories: $task->getCategories()->map(fn(Category $category): CategoryResponse => 
                                                    new CategoryResponse(
                                                        id:   $category->getId(),
                                                        name: $category->getName(),
                                        )),
                    ));

        return new TaskResponses($responses);
    }
}
