<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Task\Application;

class TaskSearchAllData
{
    public function __construct(
        private readonly string $name,
    ) {  
    }

    public function getName(): string
    {
        return $this->name;
    }
}
