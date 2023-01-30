<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Category\Application;

class CategoryResponse
{
    public function __construct(
        private readonly string $id,
        private readonly string $name,
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
}
