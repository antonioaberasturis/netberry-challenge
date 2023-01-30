<?php

namespace Tests\Shared\Infrastructure\PhpUnit;

use Faker\Generator;

class LaravelFaker
{
    public static function create(): Generator
    {
        return app()->make(Generator::class);
    }
}
