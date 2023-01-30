<?php

declare(strict_types=1);

namespace Tests\TaskManager\TaskCategory\Infrastructure\Persistence\Eloquent;

use Tests\TaskManager\Task\Domain\TaskFactory;
use Tests\TaskManager\Category\Domain\CategoryFactory;
use Tests\TaskManager\TaskCategory\Domain\TaskCategoryFactory;
use Tests\TaskManager\TaskCategory\TaskCategoryModuleInfrastructureTestCase;
use Netberry\TaskManager\TaskCategory\Infrastructure\Persistence\Eloquent\TaskCategoryEloquentRepository;
use Netberry\TaskManager\TaskCategory\Infrastructure\Persistence\Eloquent\TaskCategoryModel;

class TaskCategoryEloquentRepositoryTest extends TaskCategoryModuleInfrastructureTestCase
{
    private TaskCategoryEloquentRepository $repository;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new TaskCategoryEloquentRepository();
    }

    public function testShouldSaveTaskCategory(): void
    {
        $task = TaskFactory::create();
        $category = CategoryFactory::create();
        $taskCategory = TaskCategoryFactory::make($task->getId(), $category->getId());

        $this->repository->save($taskCategory);

        $this->assertDatabaseHas(TaskCategoryModel::class, [
            "task_id"        => $taskCategory->getTaskId(),
            "category_id"    => $taskCategory->getCategoryId()
        ]);
    }

    public function testShoulRemoveByTaskId(): void
    {
        $task = TaskFactory::create();
        $category = CategoryFactory::create();
        TaskCategoryFactory::create($task->getId(), $category->getId());

        $this->repository->deleteByTaskId($task->getId());

        $this->assertDatabaseMissing(TaskCategoryModel::class, [
            "task_id"        => $task->getId(),
            "category_id"    => $category->getId()
        ]);
    }
}
