<?php

declare(strict_types=1);

namespace Tests\TaskManager\TaskCategory\Application\Create;

use Tests\TaskManager\Category\Domain\CategoryFactory;
use Tests\TaskManager\TaskCategory\TaskCategoryModuleUnitTestCase;
use Netberry\TaskManager\TaskCategory\Application\Create\TaskCategoryCreatorService;
use Tests\TaskManager\Task\Domain\TaskFactory;
use Tests\TaskManager\TaskCategory\Domain\TaskCategoryFactory;

class TaskCategoryCreatorServiceTest extends TaskCategoryModuleUnitTestCase
{
    private TaskCategoryCreatorService $creator;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->creator = new TaskCategoryCreatorService($this->repository());
    }

    public function testShouldCreateTaskCategory(): void
    {
        $category = CategoryFactory::make();
        $task = TaskFactory::make();
        $taskCategory = TaskCategoryFactory::make($task->getId(), $category->getId());
        
        $this->shouldSave($taskCategory);
        
        $this->creator->__invoke($task->getId(), [$category->getId()]);
    }
}
