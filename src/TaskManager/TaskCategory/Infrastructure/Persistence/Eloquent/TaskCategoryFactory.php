<?php

declare(strict_types=1);

namespace Netberry\TaskManager\TaskCategory\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskCategoryFactory extends Factory
{
    protected $model = TaskCategoryModel::class;

    public function definition(): array
    {
        return [
            'task_id' => $this->faker->uuid(),
            'category_id' => $this->faker->uuid(),
        ];
    }

    public function taskId(?string $id): static
    {
        return $this->state(fn(array $attributes) => [
                'task_id' => $id ?? $attributes['task_id'],
        ]);
    }

    public function categoryId(?string $id): static
    {
        return $this->state(fn(array $attributes) => [
                'category_id' => $id ?? $attributes['category_id'],
        ]);
    }
}
