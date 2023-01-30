<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Task\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Collection;
use Netberry\TaskManager\Task\Domain\Task;
use Netberry\TaskManager\Task\Domain\TaskCollection;
use Netberry\TaskManager\Task\Infrastructure\Persistence\Eloquent\TaskModel;

class TaskModelCollection extends Collection
{
    public function toTaskCollection(): TaskCollection
    {
        $tasks = $this->map(function(TaskModel $item): Task{
            $task = $item->toTask();
            $task->setCategories($item->getCategories()->toCategoryCollection());

            return $task;
        });

        return new TaskCollection(...$tasks);
    }
}
