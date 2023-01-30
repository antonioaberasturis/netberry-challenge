<?php

declare(strict_types=1);

namespace Tests\TaskManager\Category\Application\Finder;

use Tests\TaskManager\Category\Domain\CategoryFactory;
use Tests\TaskManager\Category\CategoryModuleUnitTestCase;
use Netberry\TaskManager\Category\Domain\CategoryNotFoundException;
use Netberry\TaskManager\Category\Application\Finder\CategoryFinderService as FinderCategoryFinderService;

class CategoryFinderServiceTest extends CategoryModuleUnitTestCase
{
    private FinderCategoryFinderService $finder;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->finder = new FinderCategoryFinderService($this->repository());
    }

    public function testShouldFindCategoryById(): void
    {
        $category = CategoryFactory::make();
        $categoryId = $category->getId();
        
        $this->shouldFind($categoryId, $category);
        
        $response = $this->finder->__invoke($categoryId);
        
        $this->assertEquals($category, $response);
    }

    public function testShouldThrowExceptionWhenFindNotExistingCategory(): void
    {
        $this->expectException(CategoryNotFoundException::class);

        $category = CategoryFactory::make();
        $categoryId = $category->getId();
        
        $this->shouldFind($categoryId, null);
        
        $this->finder->__invoke($categoryId);
    }
}
