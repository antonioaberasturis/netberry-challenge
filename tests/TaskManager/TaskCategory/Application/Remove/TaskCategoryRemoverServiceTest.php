<?php

declare(strict_types=1);

namespace Tests\TaskManager\TaskCategory\Application\Remove;

use Tests\TaskManager\Task\Domain\TaskFactory;
use Tests\TaskManager\TaskCategory\TaskCategoryModuleUnitTestCase;
use Netberry\TaskManager\TaskCategory\Application\Remove\TaskCategoryRemoverService;

class TaskCategoryRemoverServiceTest extends TaskCategoryModuleUnitTestCase
{
    private TaskCategoryRemoverService $remover;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->remover = new TaskCategoryRemoverService($this->repository());
    }

    public function testShouldRemoveTaskCategory(): void
    {
        $task = TaskFactory::make();
        
        $this->shouldRemoveByTaskId($task->getId());
        
        $this->remover->__invoke($task->getId());
    }
}
