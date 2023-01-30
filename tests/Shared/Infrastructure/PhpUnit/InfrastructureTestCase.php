<?php

declare(strict_types=1);

namespace Tests\Shared\Infrastructure\PhpUnit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class InfrastructureTestCase extends TestCase
{
    use RefreshDatabase;
}
