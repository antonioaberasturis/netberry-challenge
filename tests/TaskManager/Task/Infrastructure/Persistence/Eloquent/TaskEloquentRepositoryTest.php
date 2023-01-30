<?php

declare(strict_types=1);

namespace Tests\TaskManager\Task\Infrastructure\Persistence\Eloquent;

use Tests\TaskManager\Task\Domain\TaskFactory;
use Tests\TaskManager\Task\Domain\TaskCollectionFactory;
use Tests\TaskManager\Task\Infrastructure\TaskModuleInfrastructureTestCase;
use Netberry\TaskManager\Task\Infrastructure\Persistence\Eloquent\TaskEloquentRepository;

class TaskEloquentRepositoryTest extends TaskModuleInfrastructureTestCase
{
    private TaskEloquentRepository $repository;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new TaskEloquentRepository();
    }

    public function testShouldSearchAllExistingTasks(): void
    {
        $tasks = TaskCollectionFactory::createWithTask(1);

        $collection = $this->repository->searchAll();

        $this->assertEquals($tasks, $collection);
    }

    public function testShouldNotSearchNotExistingTasks(): void
    {
        $collection = $this->repository->searchAll();

        $this->assertTrue($collection->isEmpty());
    }

    public function testShouldFindAnExistingTask(): void
    {
        $task = TaskFactory::create();

        $response = $this->repository->find($task->getId());

        $this->assertEquals($task, $response);
    }

    public function testShouldNotFindANotExistingTask(): void
    {
        $task = TaskFactory::make();

        $response = $this->repository->find($task->getId());

        $this->assertNull($response);
    }

    public function testShouldSaveATask(): void
    {
        $task = TaskFactory::make();

        $this->repository->save($task);
        $response = $this->repository->find($task->getId());

        $this->assertEquals($task, $response);
    }

    public function testShouldRemoveATask(): void
    {
        $task = TaskFactory::create();

        $this->repository->delete($task->getId());
        $response = $this->repository->find($task->getId());

        $this->assertEmpty($response);
    }
}
