<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class ServiceTestCase extends TestCase
{
    abstract protected function service();

    protected $service;

    public function setUp()
    {
        parent::setUp();

        $this->service = $this->app->make($this->service());
    }

    protected function syncTest($entityClass, $toSyncClass, $method)
    {
        $entity = factory($entityClass)->create();
        $toSync = factory($toSyncClass, 3)->create();

        $changes = $this->service->$method($entity, $toSync);

        $this->assertTrue(count($changes['attached']) === 3);
    }

}