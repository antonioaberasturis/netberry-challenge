<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Task\Application\Remove;

use Netberry\TaskManager\Task\Domain\TaskRepository;
use Netberry\TaskManager\TaskCategory\Application\Remove\TaskCategoryRemoverService;

class TaskRemover
{
    public function __construct(
        private TaskRepository $repository,
        private TaskCategoryRemoverService $taskCategoryRemover
    ){
    }

    public function __invoke(string $taskId): void
    {
        $this->taskCategoryRemover->__invoke($taskId);
        $this->repository->delete($taskId);
    }
}
