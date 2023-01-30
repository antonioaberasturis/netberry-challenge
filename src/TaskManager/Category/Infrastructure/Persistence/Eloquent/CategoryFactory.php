<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Category\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = CategoryModel::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'name' => $this->faker->randomElement(['PHP', 'JAVASCRIPT', 'CSS']),
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
