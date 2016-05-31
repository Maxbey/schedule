<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TroopServiceTest extends ServiceTestCase
{

    protected function service()
    {
        return 'TroopService';
    }

    public function testCreateMethod()
    {
        $attributes = [
            'code' => '231',
            'day' => 3,
            'term' => 1
        ];

        $specialty = factory(App\Entities\Specialty::class)->create();
        $troop = $this->service->create($specialty, $attributes);

        $this->seeInDatabase('troops', ['id' => $troop->id]);
    }

    public function testUpdateMethod()
    {
        $troop = factory(App\Entities\Troop::class)->create();
        $specialty = factory(App\Entities\Specialty::class)->create();

        $this->service->update($troop->id, $specialty, ['code' => '132']);

        $this->seeInDatabase('troops', ['specialty_id' => $specialty->id]);
    }
}
