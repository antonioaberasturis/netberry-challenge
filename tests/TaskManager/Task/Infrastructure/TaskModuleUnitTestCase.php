<?php

declare(strict_types=1);

namespace Tests\TaskManager\Task\Infrastructure;

use Mockery;
use DomainException;
use Mockery\MockInterface;
use Netberry\TaskManager\Task\Domain\Task;
use Netberry\TaskManager\Task\Domain\TaskCollection;
use Netberry\TaskManager\Task\Domain\TaskRepository;
use Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Netberry\TaskManager\TaskCategory\Application\Create\TaskCategoryCreatorService;
use Netberry\TaskManager\TaskCategory\Application\Remove\TaskCategoryRemoverService;
use Netberry\TaskManager\Category\Application\Checker\CategoryExistsCheckerByIdsService;

abstract class TaskModuleUnitTestCase extends UnitTestCase
{
    private TaskRepository  $repository;
    private CategoryExistsCheckerByIdsService $categoryExistsCheckerByIdsService;
    private TaskCategoryCreatorService $taskCategoryCreatorService;
    private TaskCategoryRemoverService $taskCategoryRemoverService;

    protected function shouldSearchAll(TaskCollection $return): void
    {
        $this->repository()
            ->shouldReceive('searchAll')
            ->withNoArgs()
            ->once()
            ->andReturn($return);
    }

    protected function shouldFind(string $id, ?Task $return): void
    {
        $this->repository()
            ->shouldReceive('find')
            ->with($id)
            ->once()
            ->andReturn($return);
    }

    protected function shouldRemove(string $taskId): void
    {
        $this->repository()
            ->shouldReceive('delete')
            ->with($taskId)
            ->once()
            ->andReturnNull();
    }

    protected function shouldSave(Task $task): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with(Mockery::on(fn($arg) => $arg == $task))
            ->once()
            ->andReturnNull();
    }

    protected function shouldCheckExistsCategoryIds(array $ids): void
    {
        $this->categoryExistsCheckerByIdsService()
            ->shouldReceive('__invoke')
            ->with($ids)
            ->once()
            ->andReturnNull();
    }

    protected function shouldThrowExceptionWhenCheckCategoryIds(array $ids, $exception): void
    {
        $this->categoryExistsCheckerByIdsService()
            ->shouldReceive('__invoke')
            ->with($ids)
            ->once()
            ->andThrow($exception);
    }

    protected function shouldCreateTaskCategory(string $id, array $ids): void
    {
        $this->taskCategoryCreatorService()
            ->shouldReceive('__invoke')
            ->with($id, $ids)
            ->once()
            ->andReturnNull();
    }

    protected function shouldRemoveTaskCategory(string $taskId): void
    {
        $this->taskCategoryRemoverService()
            ->shouldReceive('__invoke')
            ->with($taskId)
            ->once()
            ->andReturnNull();
    }

    protected function repository(): MockInterface|TaskRepository
    {
        return $this->repository = $this->repository ?? $this->mock(TaskRepository::class);
    }

    protected function categoryExistsCheckerByIdsService(): MockInterface|CategoryExistsCheckerByIdsService
    {
        return $this->categoryExistsCheckerByIdsService = $this->categoryExistsCheckerByIdsService ?? $this->mock(CategoryExistsCheckerByIdsService::class);
    }

    protected function taskCategoryCreatorService(): MockInterface|TaskCategoryCreatorService
    {
        return $this->taskCategoryCreatorService = $this->taskCategoryCreatorService ?? $this->mock(TaskCategoryCreatorService::class);
    }

    protected function taskCategoryRemoverService(): MockInterface|TaskCategoryRemoverService
    {
        return $this->taskCategoryRemoverService = $this->taskCategoryRemoverService ?? $this->mock(TaskCategoryRemoverService::class);
    }
}
