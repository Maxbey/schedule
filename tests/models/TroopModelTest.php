<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TroopModelTest extends TestCase
{
    use \App\Tests\RelationsTestHelpers;

    public function testModelCreation()
    {
        $troop = factory(App\Entities\Troop::class)->create();

        $this->seeInDatabase('troops', ['id' => $troop->id]);
    }

    public function testRelationsWithSpecialty()
    {
        $this->checkBelongsToRelation(App\Entities\Troop::class, App\Entities\Specialty::class, 'specialty');
    }

    public function testRelationsWithOccupation()
    {
        $this->checkHasManyRelation(App\Entities\Troop::class, App\Entities\Occupation::class, 'occupations');
    }
}
