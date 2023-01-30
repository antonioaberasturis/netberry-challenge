<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Category\Domain;

use Netberry\Shared\Domain\Collection;

class CategoryCollection extends Collection
{
    public function __construct(
        Category ...$categories
    ) {
        parent::__construct($categories);
    }
}
