<?php

declare(strict_types=1);

namespace Tests\TaskManager\Category\Domain;

use Netberry\TaskManager\Category\Domain\Category;
use Netberry\TaskManager\Category\Infrastructure\Persistence\Eloquent\CategoryModel;

class CategoryFactory
{
    public static function create(?string $id = null, ?string $name = null): Category 
    {
        $model = CategoryModel::factory()
                            ->id($id)
                            ->name($name)                        
                            ->create();
        
        return $model->toCategory();
    }

    public static function make(?string $id = null, ?string $name = null): Category 
    {
        $model = CategoryModel::factory()
                            ->id($id)
                            ->name($name)                        
                            ->make();
        
        return $model->toCategory();
    }

    public static function makeIds(int $count = 2): array
    {
        return CategoryModel::factory()
                            ->count($count)
                            ->make()
                            ->map(fn($item) => $item->getKey())
                            ->toArray();
    }
}
