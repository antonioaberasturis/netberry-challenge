<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Task\Domain;

use Netberry\TaskManager\Category\Domain\CategoryCollection;

class Task
{
    private CategoryCollection $categories;

    public function __construct(
        private string $id,
        private string $name,
    ) {
        $this->categories = new CategoryCollection(...[]);
    }

    public function setCategories(CategoryCollection $categories): void
    {
        $this->categories = $categories;
    }

    public function getCategories(): CategoryCollection
    {
        return $this->categories;
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
