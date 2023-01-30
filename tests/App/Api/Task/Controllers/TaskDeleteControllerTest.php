<?php

declare(strict_types=1);

namespace Tests\App\Api\Task\Controllers;

use Tests\TaskManager\Task\Domain\TaskFactory;
use Tests\TaskManager\Category\Domain\CategoryFactory;
use Tests\TaskManager\TaskCategory\Domain\TaskCategoryFactory;
use Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;

class TaskDeleteControllerTest extends InfrastructureTestCase
{
    public function testShouldRemoveATask(): void
    {
        $category = CategoryFactory::create();
        $task = TaskFactory::create();
        TaskCategoryFactory::create($task->getId(), $category->getId());

        $response = $this->delete("api/tasks/{$task->getId()}");

        $response->assertStatus(204);
    }
}
