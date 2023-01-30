<?php

declare(strict_types=1);

namespace Tests\TaskManager\Task\Domain;

use Netberry\TaskManager\Task\Domain\Task;
use Netberry\TaskManager\Task\Application\TaskData;
use Netberry\TaskManager\Task\Infrastructure\Persistence\Eloquent\TaskModel;

class TaskFactory
{
    public static function make(?string $id = null, ?string $name = null): Task
    {
        $model = TaskModel::factory()
                            ->id($id)
                            ->name($name)                        
                            ->make();
        
        return $model->toTask();
    }

    public static function create(?string $id = null, ?string $name = null): Task
    {
        $model = TaskModel::factory()
                            ->id($id)
                            ->name($name)                        
                            ->create();
        
        return $model->toTask();
    }

    public static function makeCount(int $count = 2): array
    {
        $tasks = [];
        foreach(range(1, $count) as $item){
            $tasks[] = static::make();
        }
        
        return $tasks;
    }

    public static function createCount(int $count = 2): array
    {
        $tasks = [];
        foreach(range(1, $count) as $item){
            $tasks[] = static::create();
        }
        
        return $tasks;
    }

    public static function makeFromData(TaskData $data): Task
    {
        return static::make(
            id:     $data->getId(),
            name:   $data->getName(),
        );
    }
}
