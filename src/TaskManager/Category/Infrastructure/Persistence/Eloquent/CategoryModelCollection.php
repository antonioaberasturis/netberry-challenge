<?php

namespace Netberry\TaskManager\Category\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Collection;
use Netberry\TaskManager\Category\Domain\Category;
use Netberry\TaskManager\Category\Domain\CategoryCollection;

class CategoryModelCollection extends Collection
{
    public function toCategoryCollection(): CategoryCollection
    {
        $categories = $this->map(fn(CategoryModel $item): Category => $item->toCategory());

        return new CategoryCollection(...$categories);
    }
}