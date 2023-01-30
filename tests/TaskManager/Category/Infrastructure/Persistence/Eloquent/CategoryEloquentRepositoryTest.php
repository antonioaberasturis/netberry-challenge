<?php

declare(strict_types=1);

namespace Tests\TaskManager\Category\Infrastructure\Persistence\Eloquent;

use Netberry\TaskManager\Category\Infrastructure\Persistence\Eloquent\CategoryEloquentRepository;
use Tests\TaskManager\Category\CategoryModuleInfrastructureTestCase;
use Tests\TaskManager\Category\Domain\CategoryCollectionFactory;
use Tests\TaskManager\Category\Domain\CategoryFactory;

class CategoryEloquentRepositoryTest extends CategoryModuleInfrastructureTestCase
{
    private CategoryEloquentRepository $repository;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new CategoryEloquentRepository();
    }

    public function testShouldSearchAllExistingCategories(): void
    {
        $categories = CategoryCollectionFactory::createWithCategories(1);

        $collection = $this->repository->searchAll();

        $this->assertEquals($categories, $collection);
    }

    public function testShouldNotSearchNotExistingCategories(): void
    {
        $collection = $this->repository->searchAll();

        $this->assertTrue($collection->isEmpty());
    }

    public function testShouldFindAnExistingCategory(): void
    {
        $category = CategoryFactory::create();

        $response = $this->repository->find($category->getId());

        $this->assertEquals($category, $response);
    }

    public function testShouldNotFindANotExistingCategory(): void
    {
        $category = CategoryFactory::make();

        $response = $this->repository->find($category->getId());

        $this->assertNull($response);
    }

    public function testShouldVerifyTrueIfExistsAllCategoryIds(): void
    {
        $ids = [
            CategoryFactory::create()->getId(),
            CategoryFactory::create()->getId(),
        ];

        $response = $this->repository->existsByIds($ids);

        $this->assertTrue($response);
    }

    public function testShouldVerifyFalseIfNotExistsAllCategoryIds(): void
    {
        $ids = [
            CategoryFactory::make()->getId(),
            CategoryFactory::make()->getId(),
        ];

        $response = $this->repository->existsByIds($ids);

        $this->assertFalse($response);
    }

    public function testShouldVerifyFalseIfNotExistsAtleastOneCategoryIds(): void
    {
        $ids = [
            CategoryFactory::create()->getId(),
            CategoryFactory::make()->getId(),
        ];

        $response = $this->repository->existsByIds($ids);

        $this->assertFalse($response);
    }
}
