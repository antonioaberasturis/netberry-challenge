<?php

declare(strict_types=1);

namespace Tests\TaskManager\Task\Application\Remove;

use Tests\TaskManager\Task\Domain\TaskFactory;
use Netberry\TaskManager\Task\Application\Remove\TaskRemover;
use Tests\TaskManager\Task\Infrastructure\TaskModuleUnitTestCase;

class TaskRemoverTest extends TaskModuleUnitTestCase
{
    private TaskRemover $remover;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->remover = new TaskRemover(
            $this->repository(),
            $this->taskCategoryRemoverService()
        );
    }

    public function testShouldRemoveTask(): void
    {
        $taskId = TaskFactory::make()->getId();

        $this->shouldRemove($taskId);
        $this->shouldRemoveTaskCategory($taskId);
        
        $this->remover->__invoke($taskId);
    }
}
