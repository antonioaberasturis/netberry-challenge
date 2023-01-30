<?php

declare(strict_types=1);

namespace Netberry\TaskManager\TaskCategory\Infrastructure\Persistence\Eloquent;

use Netberry\TaskManager\TaskCategory\Domain\TaskCategory;
use Netberry\TaskManager\TaskCategory\Domain\TaskCategoryRepository;
use Netberry\Shared\Infrastructure\Laravel\Persistence\Eloquent\EloquentRepository;
use Netberry\TaskManager\TaskCategory\Infrastructure\Persistence\Eloquent\TaskCategoryModel;

class TaskCategoryEloquentRepository extends EloquentRepository implements TaskCategoryRepository
{
    public function save(TaskCategory $taskCategory): void
    {
        TaskCategoryModel::create([
            'task_id'    => $taskCategory->getTaskId(),
            'category_id'  => $taskCategory->getCategoryId(),
        ]);
    }

    public function deleteByTaskId(string $taskId): void
    {
        TaskCategoryModel::where('task_id', $taskId)->delete();
    }

}
