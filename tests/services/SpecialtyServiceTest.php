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
            'code' => '123-300-1'
        ];

        $specialty = $this->service->create($attributes);

        $this->seeInDatabase('specialties', ['id' => $specialty->id]);
    }

    public function testSyncDisciplinesMethod()
    {
        $this->syncTest(\App\Entities\Specialty::class, \App\Entities\Discipline::class, 'syncDisciplines');
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
