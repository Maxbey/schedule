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
            'code' => '231'
        ];

        $specialty = factory(App\Entities\Specialty::class)->create();
        $troop = $this->service->create($specialty, $attributes);

        $this->seeInDatabase('troops', ['id' => $troop->id]);
    }
}
