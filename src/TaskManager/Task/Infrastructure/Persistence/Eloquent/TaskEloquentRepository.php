<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Task\Infrastructure\Persistence\Eloquent;

use Netberry\TaskManager\Task\Domain\Task;
use Netberry\TaskManager\Task\Domain\TaskCollection;
use Netberry\TaskManager\Task\Domain\TaskRepository;
use Netberry\TaskManager\Task\Infrastructure\Persistence\Eloquent\TaskModel;
use Netberry\Shared\Infrastructure\Laravel\Persistence\Eloquent\EloquentRepository;

class TaskEloquentRepository extends EloquentRepository implements TaskRepository
{
    public function find(string $taskId): ?Task
    {
        /** @var TaskModel $task */
        $task = TaskModel::find($taskId);
        
        if(null !== $task){
            return $task->toTask();
        }

        return null;
    }

    public function save(Task $task): void
    {
        TaskModel::create([
            'id'    => $task->getId(),
            'name'  => $task->getName(),
        ]);
    }

    public function delete(string $taskId): void
    {
        TaskModel::where('id', $taskId)->delete();
    }

    public function searchAll(): TaskCollection
    {
        $tasks = TaskModel::with('categories')->get();

        return  $tasks->toTaskCollection();
    }
}
