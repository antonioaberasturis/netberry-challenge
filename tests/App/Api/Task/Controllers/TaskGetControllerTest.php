<?php

declare(strict_types=1);

namespace Tests\App\Api\Task\Controllers;

use Tests\TaskManager\Task\Domain\TaskFactory;
use Tests\TaskManager\Category\Domain\CategoryFactory;
use Tests\TaskManager\TaskCategory\Domain\TaskCategoryFactory;
use Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;

class TaskGetControllerTest extends InfrastructureTestCase
{
    public function testShouldGetAllTasks(): void
    {
        $category       = CategoryFactory::create();
        $task           = TaskFactory::create();
        TaskCategoryFactory::create($task->getId(), $category->getId());

        $response = $this->get("api/tasks");

        $response->assertStatus(200)->assertExactJson([
            [
                "id" => $task->getId(),
                "name" => $task->getName(),
                "categories" => [
                    [
                        "id" => $category->getId(),
                        "name" => $category->getName(),
                    ]
                ]
            ]
        ]);
    }

    public function testShouldGetEmptyTasks(): void
    {
        $response = $this->get("api/tasks");

        $response->assertStatus(200)->assertExactJson([]);
    }
}
