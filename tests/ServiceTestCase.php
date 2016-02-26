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

    protected function syncTest($entityClass, $toSyncClass, $method)
    {
        $entityId = factory($entityClass)->create()->id;
        $toSync = factory($toSyncClass, 3)->create();

        $changes = $this->service->$method($entityId, $toSync);

        $this->assertTrue(count($changes['attached']) === 3);
    }

}