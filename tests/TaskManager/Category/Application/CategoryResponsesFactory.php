<?php

namespace Tests\TaskManager\Category\Application;

use Netberry\TaskManager\Category\Domain\Category;
use Netberry\TaskManager\Category\Domain\CategoryCollection;
use Netberry\TaskManager\Category\Application\CategoryResponse;
use Netberry\TaskManager\Category\Application\CategoryResponses;

class CategoryResponsesFactory
{
    public static function fromCategories(array $categories): CategoryResponses 
    {
        $responses = array_map(fn($category) => 
            new CategoryResponse(
                id:   $category->getId(),
                name: $category->getName(),
            ),
            $categories
        );
        
        return new CategoryResponses($responses);
    }
}
