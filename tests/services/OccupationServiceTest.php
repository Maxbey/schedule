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
        $troop = factory(\App\Entities\Troop::class)->create();
        $theme = factory(\App\Entities\Theme::class)->create();

        $occupation = $this->service->create($troop, $theme, $attributes);

        $this->seeInDatabase('occupations', ['id' => $occupation->id]);
    }

    public function testSyncTeachersMethod()
    {
        $this->syncTest(App\Entities\Occupation::class, App\Entities\Teacher::class, 'syncTeachers');
    }

    public function testSyncAudiencesMethod()
    {
        $this->syncTest(App\Entities\Occupation::class, App\Entities\Audience::class, 'syncAudiences');
    }
}
