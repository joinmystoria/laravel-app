<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
{
    parent::setUp();

    // Run migrations for testing database
    $this->artisan('migrate', ['--env' => 'testing']);
}

}
