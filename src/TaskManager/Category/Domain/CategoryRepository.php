<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Category\Domain;

use Netberry\Shared\Domain\Collection;

interface CategoryRepository
{

    public function existsByIds(array $ids): bool;

    public function find(string $id): ?Category;
    
    public function searchAll(): Collection;
}
