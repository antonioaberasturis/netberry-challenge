<?php

declare(strict_types=1);

namespace App\Http\Controllers\Category;

use Illuminate\Http\JsonResponse;
use Netberry\Shared\ApiController;
use Netberry\TaskManager\Category\Application\SearchAll\CategorySearcherAll;
use Netberry\TaskManager\Category\Infrastructure\Responses\Laravel\Resources\CategoryResource;

class CategoriesGetController extends ApiController
{
    public function __construct(
        private CategorySearcherAll $searcher
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $responses = $this->searcher->__invoke();

        return response()->json(CategoryResource::collection($responses->items()));
    }
}
