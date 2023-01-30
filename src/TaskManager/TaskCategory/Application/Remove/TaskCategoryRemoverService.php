<?php

declare(strict_types=1);

namespace Netberry\TaskManager\TaskCategory\Application\Remove;

use Netberry\TaskManager\TaskCategory\Domain\TaskCategoryRepository;

class TaskCategoryRemoverService
{
    public function __construct(
        private TaskCategoryRepository $repository,
    ){
    }

    public function __invoke(string $taskId): void
    {
        $this->repository->deleteByTaskId($taskId);
    }
}
