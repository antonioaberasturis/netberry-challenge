<?php

declare(strict_types=1);

namespace Tests\TaskManager\Category;

use Mockery\MockInterface;
use Netberry\TaskManager\Category\Domain\Category;
use Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Netberry\TaskManager\Category\Domain\CategoryCollection;
use Netberry\TaskManager\Category\Domain\CategoryRepository;

abstract class CategoryModuleUnitTestCase extends UnitTestCase
{
    private CategoryRepository  $repository;

    protected function shouldSearchAll(CategoryCollection $return): void
    {
        $this->repository()
            ->shouldReceive('searchAll')
            ->withNoArgs()
            ->once()
            ->andReturn($return);
    }

    protected function shouldFind(string $id, ?Category $return): void
    {
        $this->repository()
            ->shouldReceive('find')
            ->with($id)
            ->once()
            ->andReturn($return);
    }

    protected function shouldExistsByIds(array $ids, bool $return): void
    {
        $this->repository()
            ->shouldReceive('existsByIds')
            ->with($ids)
            ->once()
            ->andReturn($return);
    }

    protected function repository(): MockInterface|CategoryRepository
    {
        return $this->repository = $this->repository ?? $this->mock(CategoryRepository::class);
    }


}
