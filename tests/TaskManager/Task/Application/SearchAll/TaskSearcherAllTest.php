<?php

declare(strict_types=1);

namespace Tests\TaskManager\Task\Application\SearchAll;

use Tests\TaskManager\Task\Domain\TaskCollectionFactory;
use Tests\TaskManager\Task\Application\TaskResponsesFactory;
use Tests\TaskManager\Task\Infrastructure\TaskModuleUnitTestCase;
use Netberry\TaskManager\Task\Application\SearchAll\TaskSearcherAll;

class TaskSearcherAllTest extends TaskModuleUnitTestCase
{
    private TaskSearcherAll $searcherAll;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->searcherAll = new TaskSearcherAll($this->repository());
    }

    public function testShouldSearchAllTasks(): void
    {
        $taskCollection = TaskCollectionFactory::makeWithTask(2);
        $expectedResponses = TaskResponsesFactory::fromTasks($taskCollection->items());
        
        $this->shouldSearchAll($taskCollection);
        
        $responses = $this->searcherAll->__invoke();
        
        $this->assertEquals($expectedResponses, $responses);
    }
}
