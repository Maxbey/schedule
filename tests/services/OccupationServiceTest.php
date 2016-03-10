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
        $attributes = [];
        $attributes['date_of'] = new \Carbon\Carbon;
        $attributes['troop_id'] = factory(\App\Entities\Troop::class)->create()->id;
        $attributes['theme_id'] = factory(\App\Entities\Theme::class)->create()->id;

        $occupation = $this->service->create($attributes);

        $this->seeInDatabase('occupations', ['id' => $occupation->id]);
    }
}
