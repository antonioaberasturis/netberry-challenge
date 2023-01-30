<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Task\Domain;

use Netberry\Shared\Domain\DomainError;

class TaskAlreadyExistsException extends DomainError
{
    public function errorCode(): string
    {
        return 'task_already_exists';
    }

    protected function errorMessage(): string
    {
        return 'The resource already exists';
    }
}
