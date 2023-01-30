<?php

declare(strict_types=1);

namespace Tests\TaskManager\Category\Domain;

use Netberry\TaskManager\Category\Domain\Category;
use Netberry\TaskManager\Category\Domain\CategoryCollection;

class CategoryCollectionFactory
{
    public static function make(Category ...$categories): CategoryCollection 
    {
        return new CategoryCollection(...$categories);
    }

    public static function makeWithCategories(int $count = 2): CategoryCollection 
    {
        $categories = [];
        foreach(range(1, $count) as $item){
            $categories[] = CategoryFactory::make();
        }
        
        return static::make(...$categories);
    }

    public static function createWithCategories(int $count = 2): CategoryCollection 
    {
        $categories = [];
        foreach(range(1, $count) as $item){
            $categories[] = CategoryFactory::create();
        }
        
        return static::make(...$categories);
    }
}
