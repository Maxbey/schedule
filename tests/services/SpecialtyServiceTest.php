<?php

class SpecialtyServiceTest extends ServiceTestCase
{

    protected function service()
    {
        return 'SpecialtyService';
    }

    public function testCreateMethod()
    {
        $attributes = [
            'name' => 'name of specialty',
            'code' => '123-300-1'
        ];

        $specialty = $this->service->create($attributes);

        $this->seeInDatabase('specialties', ['id' => $specialty->id]);
    }

    public function testSyncDisciplinesMethod()
    {
        $specialty_id = factory(App\Entities\Specialty::class)->create()->id;
        $disciplines = factory(App\Entities\Discipline::class, 3)->create();

        $changes = $this->service->syncDisciplines($specialty_id, $disciplines);

        $this->assertTrue(count($changes['attached']) === 3);
    }

    public function testGetByIdsMethod()
    {
        $ids = [];

        factory(App\Entities\Specialty::class, 3)->create()
            ->each(function($specialty) use(&$ids){
                $ids[] = $specialty->id;
            });

        $collection = $this->service->getByIds($ids);

        $this->assertTrue($collection->count() === 3);

    }
}
