<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Category\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Netberry\TaskManager\Category\Domain\Category;
use Netberry\TaskManager\Category\Domain\CategoryCollection;
use Netberry\TaskManager\Category\Domain\CategoryRepository;
use Netberry\Shared\Infrastructure\Laravel\Persistence\Eloquent\EloquentRepository;
use Netberry\TaskManager\Category\Infrastructure\Persistence\Eloquent\CategoryModel;

class CategoryEloquentRepository extends EloquentRepository implements CategoryRepository
{

    public function existsByIds(array $ids): bool
    {
        try{
            CategoryModel::findOrFail($ids);
        }catch(ModelNotFoundException){
            
            return false;
        }

        return true;
    }

    public function find(string $id): ?Category
    {
        /** @var CategoryModel $category */
        $category = CategoryModel::find($id);

        if(null === $category){
            return null;
        }

        return $category->toCategory();
    }

    public function searchAll(): CategoryCollection
    {
        $categories = CategoryModel::all();

        $collection = $categories->map(fn($item) => new Category(
            id:     $item->id,
            name:   $item->name,
        ));
        
        return new CategoryCollection(...$collection);
    }
}
