<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \App\Repositories\AudiencesRepository;

class SpecialtyServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreateMethod()
    {
        $attributes = [
            'name' => 'name of specialty',
            'code' => '123-300-1'
        ];

        $specialty = SpecialtyService::create($attributes);

        $this->seeInDatabase('specialties', ['id' => $specialty->id]);
    }

    public function testSyncDisciplinesMethod()
    {
        $specialty_id = factory(App\Entities\Specialty::class)->create()->id;
        $disciplines = factory(App\Entities\Discipline::class, 3)->create();

        $changes = SpecialtyService::syncDisciplines($specialty_id, $disciplines);

        $this->assertTrue(count($changes['attached']) === 3);
    }

    public function testGetByIdsMethod()
    {
        $ids = [];

        factory(App\Entities\Specialty::class, 3)->create()
            ->each(function($specialty) use(&$ids){
                $ids[] = $specialty->id;
            });

        $collection = SpecialtyService::getByIds($ids);

        $this->assertTrue($collection->count() === 3);

    }
}
