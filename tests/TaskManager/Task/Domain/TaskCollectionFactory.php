<?php

declare(strict_types=1);

namespace Tests\TaskManager\Task\Domain;

use Netberry\TaskManager\Task\Domain\Task;
use Netberry\TaskManager\Task\Domain\TaskCollection;

class TaskCollectionFactory
{
    public static function make(Task ...$tasks): TaskCollection 
    {
        return new TaskCollection(...$tasks);
    }

    public static function makeWithTask(int $count = 2): TaskCollection 
    {
        $tasks = TaskFactory::makeCount($count);
        
        return static::make(...$tasks);
    }

    public static function createWithTask(int $count = 2): TaskCollection 
    {
        $tasks = TaskFactory::createCount($count);
        
        return static::make(...$tasks);
    }
}
