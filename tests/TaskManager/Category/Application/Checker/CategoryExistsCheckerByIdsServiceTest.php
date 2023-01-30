<?php

declare(strict_types=1);

namespace Tests\TaskManager\Category\Application\Checker;

use Tests\TaskManager\Category\Domain\CategoryFactory;
use Tests\TaskManager\Category\CategoryModuleUnitTestCase;
use Netberry\TaskManager\Category\Domain\CategoryNotFoundException;
use Netberry\TaskManager\Category\Application\Checker\CategoryExistsCheckerByIdsService;

class CategoryExistsCheckerByIdsServiceTest extends CategoryModuleUnitTestCase
{
    private CategoryExistsCheckerByIdsService $checker;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->checker = new CategoryExistsCheckerByIdsService($this->repository());
    }

    public function testShouldCheckExistingCategoryIds(): void
    {
        $ids = [
            CategoryFactory::make()->getId(), 
            CategoryFactory::make()->getId(),
        ];
        
        $this->shouldExistsByIds($ids, true);
        
        $this->checker->__invoke($ids);
    }

    public function testShouldThrowExceptionWhenCheckToNotExistingCategoryIds(): void
    {
        $this->expectException(CategoryNotFoundException::class);
        $ids = [
            CategoryFactory::make()->getId(), 
            CategoryFactory::make()->getId(),
        ];
        
        $this->shouldExistsByIds($ids, false);
        
        $this->checker->__invoke($ids);
    }
}
