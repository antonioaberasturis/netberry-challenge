<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Netberry\Shared\ApiController;
use Netberry\TaskManager\Task\Application\Remove\TaskRemover;
use Netberry\Shared\Infrastructure\Laravel\Persistence\Eloquent\EloquentTransactionWrapper;

class TaskDeleteController extends ApiController
{
    public function __construct(
        private TaskRemover $remover,
        private EloquentTransactionWrapper $transactionWrapper
    ) {
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        $this->transactionWrapper->__invoke( fn() => $this->remover->__invoke($id) );
        
        return response()->json([], 204);
    }
}
