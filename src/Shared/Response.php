<?php

declare(strict_types=1);

namespace Netberry\Shared;

abstract class Response
{
    public function __construct(
        private readonly array $items
    ) {
    }

    public function items(): array
    {
        return $this->items;
    }
}
