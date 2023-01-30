<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Category\Infrastructure\Responses\Laravel\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request = null)
    {
        return [
            'id'    => $this->getId(),
            'name'  => $this->getName(),
        ];
    }
}
