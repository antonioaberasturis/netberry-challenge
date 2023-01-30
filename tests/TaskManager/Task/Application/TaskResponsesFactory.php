<?php

declare(strict_types=1);

namespace Tests\TaskManager\Task\Application;

use Netberry\TaskManager\Category\Application\CategoryResponse;
use Netberry\TaskManager\Task\Application\TaskResponse;
use Netberry\TaskManager\Task\Application\TaskResponses;

class TaskResponsesFactory
{
    public static function fromTasks(array $tasks): TaskResponses 
    {
        $responses = array_map(fn($task) => 
            new TaskResponse(
                id:         $task->getId(),
                name:       $task->getName(),
                categories: $task->getCategories()->map(fn($category) => 
                                new CategoryResponse(
                                    id:   $category->getId(),
                                    name: $category->getName(),
                                )
                )
            ),
            $tasks
        );
        
        return new TaskResponses($responses);
    }
}
