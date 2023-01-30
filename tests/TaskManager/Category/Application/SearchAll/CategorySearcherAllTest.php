<?php

declare(strict_types=1);

namespace Tests\TaskManager\Category\Application\SearchAll;

use Netberry\TaskManager\Category\Application\SearchAll\CategorySearcherAll;
use Tests\TaskManager\Category\Application\CategoryResponsesFactory;
use Tests\TaskManager\Category\CategoryModuleUnitTestCase;
use Tests\TaskManager\Category\Domain\CategoryCollectionFactory;

class CategorySearcherAllTest extends CategoryModuleUnitTestCase
{
    private CategorySearcherAll $searcherAll;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->searcherAll = new CategorySearcherAll($this->repository());
    }

    public function testShouldSearchAllCategories(): void
    {
        $categoryCollection = CategoryCollectionFactory::makeWithCategories(2);
        $expectedResponses = CategoryResponsesFactory::fromCategories($categoryCollection->items());
        
        $this->shouldSearchAll($categoryCollection);
        
        $responses = $this->searcherAll->__invoke();
        
        $this->assertEquals($expectedResponses, $responses);
    }
}
