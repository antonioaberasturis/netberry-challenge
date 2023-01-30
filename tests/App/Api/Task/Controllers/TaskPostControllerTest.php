<?php

declare(strict_types=1);

namespace Tests\App\Api\Task\Controllers;

use Tests\TaskManager\Category\Domain\CategoryFactory;
use Tests\TaskManager\Task\Application\TaskDataFactory;
use Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;

class TaskPostControllerTest extends InfrastructureTestCase
{
    public function testShouldCreateATask(): void
    {
        $category = CategoryFactory::create();
        $taskData = TaskDataFactory::makeForRequest(
            categoryIds: [$category->getId()]
        );

        $response = $this->post("api/tasks", $taskData);

        $response->assertStatus(201)->assertExactJson([]);
    }
}
