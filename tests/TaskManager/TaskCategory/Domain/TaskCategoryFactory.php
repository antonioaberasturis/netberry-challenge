<?php

declare(strict_types=1);

namespace Tests\TaskManager\TaskCategory\Domain;

use Netberry\TaskManager\TaskCategory\Domain\TaskCategory;
use Netberry\TaskManager\TaskCategory\Infrastructure\Persistence\Eloquent\TaskCategoryModel;

class TaskCategoryFactory
{
    public static function create(?string $taskId = null, ?string $categoryId = null): void
    {
        $model = TaskCategoryModel::factory()
                            ->taskId($taskId)
                            ->categoryId($categoryId)                        
                            ->create();
    }

    public static function make(?string $taskId = null, ?string $categoryId = null): TaskCategory
    {
        $model = TaskCategoryModel::factory()
                            ->taskId($taskId)
                            ->categoryId($categoryId)                        
                            ->make();
                            
        return $model->toTaskCategory();
    }
}
