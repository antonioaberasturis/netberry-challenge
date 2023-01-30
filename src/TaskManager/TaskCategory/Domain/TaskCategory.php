<?php

declare(strict_types=1);

namespace Netberry\TaskManager\TaskCategory\Domain;

class TaskCategory
{
    public function __construct(
        private string $taskId,
        private string $categoryId,
    ) {
    }

    public function getTaskId(): string
    {
        return $this->taskId;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }
}
