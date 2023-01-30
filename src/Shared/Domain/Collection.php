<?php

declare(strict_types=1);

namespace Netberry\Shared\Domain;

abstract class Collection
{
    public function __construct(
        protected array $items
    ) {
    }

    public function items(): array
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    public function map(callable $callback): array
    {
        return array_map($callback, $this->items);
    }
}
