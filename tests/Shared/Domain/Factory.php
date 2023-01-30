<?php

namespace Tests\Shared\Domain;

use Faker\Generator;
use Tests\Shared\Infrastructure\PhpUnit\LaravelFaker;

class Factory
{
    private static $faker = null;

    public static function random(): Generator
    {
        return self::$faker = self::$faker ?? LaravelFaker::create();
    } 
}
