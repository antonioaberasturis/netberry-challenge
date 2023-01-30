<?php

declare(strict_types=1);

namespace Tests\TaskManager\TaskCategory;

use Mockery;
use Mockery\MockInterface;
use Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Netberry\TaskManager\TaskCategory\Domain\TaskCategory;
use Netberry\TaskManager\TaskCategory\Domain\TaskCategoryRepository;

class TaskCategoryModuleUnitTestCase extends UnitTestCase
{
    private TaskCategoryRepository  $repository;

    protected function shouldSave(TaskCategory $taskCategory): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with(Mockery::on(fn($arg) => $arg == $taskCategory))
            ->once()
            ->andReturnNull();
    }

    protected function shouldRemoveByTaskId(string $taskId): void
    {
        $this->repository()
            ->shouldReceive('deleteByTaskId')
            ->with($taskId)
            ->once()
            ->andReturnNull();
    }

    protected function repository(): MockInterface|TaskCategoryRepository
    {
        return $this->repository = $this->repository ?? $this->mock(TaskCategoryRepository::class);
    }
}
