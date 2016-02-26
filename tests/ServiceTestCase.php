<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class ServiceTestCase extends TestCase
{
    use DatabaseMigrations;

    abstract protected function service();

    protected $service;

    protected function setUp()
    {
        parent::setUp();

        $this->service = $this->app->make($this->service());
    }
}