<?php

declare(strict_types=1);

namespace Netberry\TaskManager\Category\Domain;

use Netberry\Shared\Domain\DomainError;

class CategoryNotFoundException extends DomainError
{
    public function errorCode(): string
    {
        return 'category_not_found';
    }

    protected function errorMessage(): string
    {
        return 'The resource not found';
    }
}
