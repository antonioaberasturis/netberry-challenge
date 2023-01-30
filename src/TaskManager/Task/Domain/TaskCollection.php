<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Task\Domain;

use Netberry\Shared\Domain\Collection;

class TaskCollection extends Collection
{
    public function __construct(
        Task ...$tasks
    ) {
        parent::__construct($tasks);
    }
}
