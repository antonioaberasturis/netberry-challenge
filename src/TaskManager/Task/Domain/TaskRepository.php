<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Task\Domain;

use Netberry\Shared\Domain\Collection;
use Netberry\TaskManager\Task\Domain\Task;

interface TaskRepository
{
    public function find(string $taskId): ?Task;
    
    public function save(Task $task): void;

    public function delete(string $taskId): void;

    public function searchAll(): Collection;
}
