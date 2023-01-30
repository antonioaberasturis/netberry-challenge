<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function resolveDependence($abstract): mixed
    {
        return $this->app->make($abstract);
    }
}
