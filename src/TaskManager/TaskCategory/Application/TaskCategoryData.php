<?php

declare(strict_types=1);

namespace Netberry\TaskManager\TaskCategory\Application;

class TaskCategoryData
{
    public function __construct(
        private readonly string $taskId,
        private readonly string $categoryId,
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
