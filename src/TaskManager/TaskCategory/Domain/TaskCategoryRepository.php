<?php

declare(strict_types=1);

namespace Netberry\TaskManager\TaskCategory\Domain;

interface TaskCategoryRepository
{
    public function save(TaskCategory $taskCategory): void;

    public function deleteByTaskId(string $taskId): void;
}
