<?php

declare(strict_types=1);

namespace Tests\App\Api\Category\Controllers;

use Illuminate\Testing\TestResponse;
use Tests\TaskManager\Category\Domain\CategoryFactory;
use Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;

class CategoriesGetControllerTest extends InfrastructureTestCase
{
    public function testShouldGetAllCategories(): void
    {
        $category = CategoryFactory::create();

        $response = $this->get('api/categories');

        $response->assertStatus(200)->assertExactJson([
            [
                "id" => $category->getId(),
                "name" => $category->getName(),
            ]
        ]);
    }

    public function testShouldGetEmptyCategories(): void
    {
        $response = $this->get('api/categories');

        $response->assertStatus(200)->assertExactJson([]);
    }
}
