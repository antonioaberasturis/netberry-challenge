<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Task\Infrastructure\Responses\Laravel\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Netberry\TaskManager\Category\Infrastructure\Responses\Laravel\Resources\CategoryResource;

class TaskResource extends JsonResource
{
    public function toArray($request = null)
    {
        return [
            'id'    => $this->getId(),
            'name'  => $this->getName(),
            'categories' => CategoryResource::collection($this->getCategories()),
        ];
    }
}
