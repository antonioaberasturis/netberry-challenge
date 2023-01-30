<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Task\Application;

use Netberry\Shared\Response;

class TaskResponse extends Response
{
    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly array  $categories
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

    public function getCategories(): array
    {
        return $this->categories;
    }
}
