<?php

namespace App\Http\Controllers\Task;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Netberry\TaskManager\Task\Application\SearchAll\TaskSearcherAll;
use Netberry\TaskManager\Task\Infrastructure\Responses\Laravel\Resources\TaskResource;

class TaskGetController extends Controller
{
    public function __construct(
        private TaskSearcherAll $searcher
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $responses = $this->searcher->__invoke();

        return response()->json(TaskResource::collection($responses->items()));
    }
}
