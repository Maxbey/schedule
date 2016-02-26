<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DisciplineServiceTest extends ServiceTestCase
{
    protected function service()
    {
        return 'DisciplineService';
    }

    public function testCreateMethod()
    {
        $attributes = [
            'full_name' => 'Discipline long name',
            'short_name' => 'DSN-1'
        ];

        $discipline = $this->service->create($attributes);

        $this->seeInDatabase('disciplines', ['id' => $discipline->id]);
    }
}
