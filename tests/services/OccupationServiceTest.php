<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OccupationServiceTest extends ServiceTestCase
{

    protected function service()
    {
        return 'OccupationService';
    }

    public function testCreateMethod()
    {
        $occupation = $this->service->create(
            new \Carbon\Carbon,
            factory(\App\Entities\Teacher::class)->create(),
            factory(\App\Entities\Troop::class)->create(),
            factory(\App\Entities\Theme::class)->create(),
            factory(\App\Entities\Discipline::class)->create(),
            factory(\App\Entities\Audience::class)->create()
        );

        $this->seeInDatabase('occupations', ['id' => $occupation->id]);
    }
}
