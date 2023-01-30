<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Netberry\Shared\ApiController;
use Netberry\Shared\Infrastructure\Laravel\Persistence\Eloquent\EloquentTransactionWrapper;
use Netberry\TaskManager\Task\Application\Create\TaskCreator;
use Netberry\TaskManager\Task\Application\TaskData;
use Netberry\TaskManager\Task\Infrastructure\Requests\Laravel\Requests\TaskCreateRequest;

class TaskPostController extends ApiController
{
    public function __construct(
        private TaskCreator $creator,
        private EloquentTransactionWrapper $transactionWrapper
    ) {
    }

    public function __invoke(TaskCreateRequest $request): JsonResponse
    {
        $taskData = new TaskData(
            id:          $request->input('id'),
            name:        $request->input('name'),
            categoryIds: $request->input('categoryIds'),
        );

        $this->transactionWrapper->__invoke( fn() => $this->creator->__invoke($taskData) );
        
        return response()->json([], 201);
    }
}
