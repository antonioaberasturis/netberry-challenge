<?php

declare(strict_types=1);

namespace Tests\TaskManager\Task\Application;

use Netberry\TaskManager\Task\Application\TaskData;
use Tests\Shared\Domain\Factory;
use Tests\TaskManager\Category\Domain\CategoryFactory;

class TaskDataFactory
{
    public static function make(
        ?string $id = null, 
        ?string $name = null, 
        ?array  $categoryIds = null
    ): TaskData {
        return new TaskData(
            $id                  = $id ?? Factory::random()->uuid(), 
            $name               = $name ?? Factory::random()->title(),  
            $categoryIds   = $categoryIds ?? CategoryFactory::makeIds(), 
        );
    }

    public static function makeForRequest(
        ?string $id = null, 
        ?string $name = null, 
        ?array  $categoryIds = null
    ): array {
        return [
            "id"         => $id ?? Factory::random()->uuid(), 
            "name"       => $name ?? Factory::random()->title(),  
            "categoryIds" => $categoryIds ?? CategoryFactory::makeIds(), 
        ];
    }
}
