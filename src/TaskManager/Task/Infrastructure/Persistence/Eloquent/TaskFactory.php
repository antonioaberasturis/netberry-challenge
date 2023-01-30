<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Task\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = TaskModel::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'name' => $this->faker->title(),
        ];
    }

    public function id(?string $id): static
    {
        return $this->state(fn(array $attributes) => [
                'id' => $id ?? $attributes['id'],
        ]);
    }

    public function name(?string $name): static
    {
        return $this->state(fn(array $attributes) => [
                'name' => $name ?? $attributes['name'],
        ]);
    }
}
