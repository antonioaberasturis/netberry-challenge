<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Task\Application;

class TaskData
{
    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly array  $categoryIds,
    ) {  
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function categoryIds(): array
    {
        return $this->categoryIds;
    }
}
