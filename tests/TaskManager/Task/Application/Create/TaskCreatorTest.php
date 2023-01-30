<?php

declare(strict_types=1);

namespace Tests\TaskManager\Task\Application\Create;

use Netberry\TaskManager\Category\Domain\CategoryNotFoundException;
use Netberry\TaskManager\Task\Application\Create\TaskCreator;
use Netberry\TaskManager\Task\Domain\TaskAlreadyExistsException;
use Tests\TaskManager\Task\Application\TaskDataFactory;
use Tests\TaskManager\Task\Domain\TaskFactory;
use Tests\TaskManager\Task\Infrastructure\TaskModuleUnitTestCase;

class TaskCreatorTest extends TaskModuleUnitTestCase
{
    private TaskCreator $creator;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->creator = new TaskCreator(
            $this->repository(),
            $this->categoryExistsCheckerByIdsService(),
            $this->taskCategoryCreatorService()
        );
    }

    public function testShouldCreateTask(): void
    {
        $taskData = TaskDataFactory::make();
        $task     = TaskFactory::makeFromData($taskData);

        $this->shouldFind($task->getId(), null);
        $this->shouldCheckExistsCategoryIds($taskData->categoryIds());
        $this->shouldSave($task);
        $this->shouldCreateTaskCategory($task->getId(), $taskData->categoryIds());
        
        $this->creator->__invoke($taskData);
    }

    public function testShouldThrowExceptionWhenCreateTaskAlreadyExists(): void
    {
        $this->expectException(TaskAlreadyExistsException::class);

        $taskData = TaskDataFactory::make();
        $task     = TaskFactory::makeFromData($taskData);

        $this->shouldFind($task->getId(), $task);
        
        $this->creator->__invoke($taskData);
    }

    public function testShouldThrowExceptionWhenCreateTaskWithNotExistingCategory(): void
    {
        $this->expectException(CategoryNotFoundException::class);

        $taskData = TaskDataFactory::make();
        $task     = TaskFactory::makeFromData($taskData);

        $this->shouldFind($task->getId(), null);
        $this->shouldThrowExceptionWhenCheckCategoryIds($taskData->categoryIds(), CategoryNotFoundException::class);
        
        $this->creator->__invoke($taskData);
    }
}
